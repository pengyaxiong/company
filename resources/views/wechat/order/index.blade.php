@extends('wechat.layouts.application')

@section('content')
    <div class="page-my-order" data-log="我的订单">
        {{--<div class="header">--}}
        {{--<div class="left"><a title="小米商城" data-log="HEAD-首页" onclick="history.go(-1)" class="home"><img--}}
        {{--src="http://s1.mi.com/m/images/m/icon_back_n.png" class="ib"></a></div>--}}
        {{--<div class="tit"><h2 data-log="HEAD-标题-我的订单"><span class="title">我的订单</span></h2></div>--}}
        {{--</div>--}}
        <div class="order_list">
            @foreach($orders as $order)
                <div class="ol-item">
                    <div>
                        <div class="oi1">
                            <div class="oi11">
                                <div class="oi111"><p>
                                        <strong>订单日期：</strong><span>{{ $order->created_at->format("Y年m月d日 H:i") }}</span>
                                    </p></div>
                                <div class="oi112"><p><strong>订单编号：</strong><span>{{$order->order_sn}}</span></p></div>
                            </div>
                            <div class="oi12"><p>{{order_status($order->status)}}</p></div>
                        </div>
                        <div class="oi2">
                            <ul>
                                @foreach($order->order_products as $order_product)
                                    <li>
                                        <div class="oi21">
                                            <div class="img">{!! image_url($order_product->product, ['class'=>'thumb', 'width'=>'50', 'height' => '50', 'alt'=>$order_product->product->name]) !!}
                                            </div>
                                        </div>
                                        <div class="oi22"><p>{{$order_product->product->name}}</p></div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="oi3"><p><span>共{{$order->order_products->count()}}
                                    件商品</span><span>总金额：</span><strong>{{doubleval($order->total_price)}}元</strong></p>
                        </div>
                        @if($order->status==1)
                            <div class="oi4">
                                <a href="javascript:;" class="org pay"  data-id="{{$order->id}}">立即付款</a>
                                <a href="javascript:;" data-id="{{$order->id}}" class="delete">取消订单</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        @include('wechat.layouts._footer')
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
            jsApiList: ['chooseWXPay'], // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        });
        $(function () {
            //删除
            $(".delete").click(function () {
                var _this = $(this);

                $.ajax({
                    type: 'DELETE',
                    url: '/wechat/order',
                    data: {id: _this.data('id')},
                    success: function (data) {
                        location.href = "/wechat/order";
                    }
                })
            })

            //付款
            $(".pay").click(function () {
                $.ajax({
                    type: 'POST',
                    url: '/wechat/order/pay',
                    data: {
                        order_id: $(this).data('id'),
                    },
                    success: function (data) {
                        //  console.log(data);
                        wx.chooseWXPay({
                            timestamp: data['timestamp'],
                            nonceStr: data['nonceStr'],
                            package: data['package'],
                            signType: data['signType'],
                            paySign: data['paySign'], // 支付签名
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