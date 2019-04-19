@extends('wechat.layouts.application')

@section('content')
    <div class="page-personal-center" data-log="个人中心">

        <div class="b1">
            <div class="new_info">
                <div>
                    <div class="name">{{$original['nickname']}}</div>
                    <div class="img"><img src="/wechat_image/{{$original['headimgurl']}}"></div>
                </div>
            </div>
            <div class="new_nav">
                <ul>
                    <li>
                        <a href="/wechat/order">
                            <div class="spr spr1"></div>
                            <p>全部订单</p>
                            <div class="line n">{{$order_a}}</div>
                        </a>
                    </li>
                    <li>
                        <a href="/wechat/order?status=1">
                            <div class="spr spr2"></div>
                            <p>待付款</p>
                            <div class="line n">1</div>
                        </a>
                    </li>
                    <li>
                        <a href="/wechat/order?status=2">
                            <div class="spr spr3"></div>
                            <p>待收货</p>
                            <div class="line n">1</div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <ol class="list">
            <li><strong class="sprl ise"></strong><a href="/wechat/contact">意见反馈</a></li>
            <li><strong class="sprl is"></strong><a href="/wechat/address/manage">地址管理</a></li>
        </ol>
        @include('wechat.layouts._footer')
    </div>
@endsection
