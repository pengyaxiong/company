@extends('wechat.layouts.application')

@section('content')
    <div class="page-order-checkout">
        <div class="page-order-checkout-wrap">
            <div class="b1 icon_arrow" onclick="location.href='/wechat/address'">
                @if($address)
                    <div class="b11" id="address" data-id="{{$address->id}}"><p>
                            <span>{{$address->name}}</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>{{$address->tel}}</span></p>
                    </div>
                    <div class="b13">
                        <p>{{$address->province}} {{$address->city}} {{$address->area}} {{$address->detail}}</p>
                    </div>
                @else
                    <div class="b11"><p><span>亲~, 没有收货地址!</span></p></div>
                    <div class="b13">
                        <p id="address" data-id="{{$address->id}}">
                            <span style="color:#FF5722;">请先填写一个收货地址~</span>
                        </p>
                    </div>
                @endif
            </div>
            <div class="ui_line"></div>
            <div class="b2">
                <ul>
                    <li class="on"><a href="javascript:;" class="wechatpay">微信支付</a></li>
                    {{--<li class=""><a href="javascript:;" class="">货到付款</a></li>--}}
                </ul>
            </div>
            <div class="ui_line"></div>

            <!--
            <div class="b3 icon_arrow">
                <dl>
                    <dt><span>电子发票</span><strong>发票类型</strong></dt>
                </dl>
            </div>
            <div class="b3 icon_arrow">
                <dl>
                    <dt><span>不限送货时间</span><strong>送货时间</strong></dt>
                </dl>
            </div>
            <div class="ui_line"></div>
            -->

            <div class="b8">

                @foreach($carts as $cart)
                    <div class="b8w">
                        <input type="hidden" class="cart_id" value="{{$cart->id}}">
                        <div class="b81">
                            <div class="img"><img src="{{env('QINIU_IMAGES_LINK').$cart->product->photo->identifier}}">
                            </div>
                        </div>
                        <div class="b82">
                            <div class="name"><p>
                                    <span>{{$cart->product->name}}</span></p></div>
                        </div>
                        <div class="b83">
                            <div class="price">
                                @if($cart->num > 1)
                                    <span>{{doubleval($cart->product->price)}} x {{$cart->num}} = </span>
                                @endif
                                <strong>{{doubleval($cart->product->price)}}元</strong>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="ui_line"></div>
            <div class="b5">
                <div class="b51"><p><strong>商品价格：</strong><span>{{$count['total_price']}}元</span></p></div>
                <div class="b53"><p><strong>配送费用：</strong><span>0元</span></p></div>
            </div>
            <div class="b7">
                <div class="b71"><span>共{{$count['num']}}件 合计: </span><strong>{{$count['total_price']}}元</strong></div>
                <div class="b72"><a href="javascript:;" class="ui-button" id="pay"><span>去付款</span></a></div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js" type="text/javascript" charset="utf-8"></script>
    <script>
        wx.config({
            debug: '{{$jssdk_config['debug']}}', // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            appId: '{{$jssdk_config['appId']}}', // 必填，公众号的唯一标识
            timestamp: '{{$jssdk_config['timestamp']}}', // 必填，生成签名的时间戳
            nonceStr: '{{$jssdk_config['nonceStr']}}', // 必填，生成签名的随机串
            signature: '{{$jssdk_config['signature']}}',// 必填，签名，见附录1
            jsApiList: '{{$jssdk_config['jsApiList']}}' // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        });
        $(function () {
            //付款
            $("#pay").click(function () {
                var cart_id = [];
                $(".cart_id").each(function (index) {
                    cart_id[index] = $(this).val();
                })

                $.ajax({
                    type: 'POST',
                    url: '/wechat/order/pay',
                    data: {
                        address_id: $("#address").data('id'),
                        cart_id: cart_id,
                    },
                    success: function (data) {
                        //  console.log(data);
                        wx.chooseWXPay({
                            timestamp: data.timestamp,
                            nonceStr: data.nonceStr,
                            package: data.package,
                            signType: data.signType,
                            paySign: data.paySign, // 支付签名
                            success: function (res) {
                                // 支付成功后的回调函数
                                if (res.errMsg == "chooseWXPay:ok") {
                                    alert('支付成功。');
                                    alert( JSON.stringify(res));
                                    $.ajax({
                                        type: 'POST',
                                        url: '/wechat/order/paid',
                                        data: res,
                                    });
                                    window.location.href = 'wechat/order';
                                } else {
                                    //alert(res.errMsg);
                                    alert("支付失败，请返回重试。");
                                }
                            },
                            fail: function (res) {
                                console.log(res);
                                alert("支付失败，请返回重试。");
                            }
                        });
                    }
                })
            })
        })
    </script>
@endsection