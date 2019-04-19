@extends('wechat.layouts.application')

@section('content')
    <div class="page-product-view" data-log="商品详情">

        <div class="header">
            <div class="left">
                <a onclick="location.href='/wechat'" class="icon icon-home"></a>
            </div>
            <div class="tit"><!--vue-if--></div>
            <div class="right">
                <a href="/wechat/search">
                    <div class="icon icon-search"></div>
                </a>
            </div>
        </div>

        <div class="product-view">
            <div class="b1">
                <img id="w_img" src="{{env('QINIU_IMAGES_LINK').$product->photo->identifier}}">
            </div>
            <div class="b2">
                <div class="b21">
                    <div class="b211">
                        <div class="name"><p id="w_name">{{$product->name}}</p></div>
                        <div  class="price"><strong>{{doubleval($product->price)}}元</strong></div>
                    </div>
                    <div class="b212">
                        <div class="icon-fenxiang"></div>
                    </div>
                </div>
                <div class="b22">
                    <p id="w_description">{{$product->description}}</p>
                </div>
            </div>
            <div class="mt20" style="display: none;"></div>

            <!--<ul class="b3">-->
            <!--<li><span class="on">白色</span></li>-->
            <!--</ul>-->

            <ul class="b3" style="display: none;">
                <li><span>通用</span></li>
            </ul>

            <div class="ui-b7">
                <h3>为您推荐</h3>
                <div class="ui-carousel-container">
                    <div class="ui-carousel-viewport">
                        @foreach($recommends as $p)
                            <a href="/wechat/product/{{$p->id}}">
                                <img src="{{$p->photo->identifier}}">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="b5">
                <div class="b51"></div>
                <div class="b52">
                    <div class="blc">
                        {!! $product->markdown_html_code!!}
                    </div>
                    <hr>
                    @foreach($product_galleries as $g)
                        <img src="/uploads/{{$g->photo}}">
                    @endforeach
                </div>
            </div>
            <div class="b7">
                <div class="b70">
                    <a href="/wechat/">
                        <div class="icon-home"></div>
                    </a>
                </div>
                <div class="b72">
                    @if($product->stock == 0)
                        <a href="javascript:;" class="off">暂时缺货</a>
                    @else
                        <a href="javascript:;" id="add_to_cart">立即购买</a>
                    @endif
                </div>

                <div class="b73">
                    <a href="/wechat/cart">
                        <div class="icon-gouwuche"></div>
                    </a>
                </div>
            </div>
            <a href="javascript:;" id="top" style="visibility: visible;">
                <img src="/vendor/wechat/images/top.png">
            </a>
        </div>
        <div class="share-component"></div>
    </div>
@endsection

@section('js')
    <script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        wx.config({
            debug: '{{$jssdk_config['debug']}}', // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            appId: '{{$jssdk_config['appId']}}', // 必填，公众号的唯一标识
            timestamp: '{{$jssdk_config['timestamp']}}', // 必填，生成签名的时间戳
            nonceStr: '{{$jssdk_config['nonceStr']}}', // 必填，生成签名的随机串
            signature: '{{$jssdk_config['signature']}}',// 必填，签名，见附录1
            jsApiList: '{{$jssdk_config['jsApiList']}}' // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        });
        wx.ready(function () {   //需在用户可能点击分享按钮前就先调用
            //shareData 参数记得为字符串类型
            var shareData = {
                title: $("#w_name").html(),
                desc: $("#w_description").html(),
                link: location.href,//域名必须JS安全域名
                imgUrl: $("#w_img").attr('src'),
            };

            if (wx.onMenuShareAppMessage) { //微信文档中提到这两个接口即将弃用，故判断
                wx.onMenuShareAppMessage(shareData);//1.0 分享到朋友
                wx.onMenuShareTimeline(shareData);//1.0分享到朋友圈
            } else {
                wx.updateAppMessageShareData(shareData);//1.4 分享到朋友
                wx.updateTimelineShareData(shareData);//1.4分享到朋友圈
            }

        });


        $(function () {
            $("#add_to_cart").click(function () {
                $.ajax({
                    type: 'POST',
                    datatype: 'json',
                    url: '/wechat/cart',
                    data: {product_id: "{{$product->id}}"},
                    success: function () {
                        location.href = '/wechat/cart';
                    }
                })
            })
        })
    </script>
@endsection
