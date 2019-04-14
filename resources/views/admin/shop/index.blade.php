@extends('layouts.admin.partials.application')
@section('content')
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">管理首页</strong> /
                <small>Manage Home</small>
            </div>
        </div>

        @include('layouts.admin.partials._flash')

        <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
            <li>
                <a href="{{ route('shop.order.index') }}" class="am-text-warning">
                    <span class="am-icon-btn am-icon-list-alt"></span><br/>订单管理<br/>{{ \App\Models\Shop\Order::count() }}
                </a>
            </li>

            <li>
                <a href="{{ route('shop.product.index') }}" class="am-text-success">
                    <span class="am-icon-btn am-icon-cart-plus"></span><br/>商品管理<br/>{{ \App\Models\Shop\Product::count() }}
                </a>
            </li>

            <li>
                <a href="{{ route('mobile') }}" class="am-text-danger">
                    <span class="am-icon-btn am-icon-user"></span><br/>会员管理<br/>{{ \App\Models\Shop\Customer::count() }}
                </a>
            </li>
            <li>
                <a href="{{route('system.cache.destroy')}}" data-method="delete" data-token="{{csrf_token()}}" class="am-text-secondary">
                    <span class="am-icon-btn am-icon-refresh am-icon-spin"></span><br/>清除缓存
                </a>
            </li>
        </ul>

        <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>

        <div class="am-g">
            <div class="am-u-sm-12">
                <div id="sales_count" style="width: 100%;height:400px;"></div>
            </div>
        </div>

        <div class="am-g">

            <div class="am-u-sm-12">
                <div id="sales_amount" style="width: 100%;height:400px;"></div>
            </div>
        </div>
        <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>


        <div class="am-g">
            <div class="am-u-sm-12">
                <div id="top" style="width: 100%;height:600px;"></div>
            </div>
        </div>


        <div class="am-g">
            <div class="am-u-sm-6">
                <div id="sex_count" style="height:600px;"></div>
            </div>

            <div class="am-u-sm-6">
                <div id="customer_province" style="height:600px;"></div>
            </div>
        </div>


        @include('layouts.admin.partials._footer')
    </div>
@endsection

@section('js')
    <script src="/vendor/echarts/echarts.min.js"></script>
    <script src="/vendor/echarts/china.js"></script>
    <script src="/vendor/echarts/macarons.js"></script>
    {{--<script src="/js/visualization/sales_area.js"></script>--}}


    <script src="/js/visualization/sales_count.js"></script>
    <script src="/js/visualization/sales_amount.js"></script>

    <script src="/js/visualization/top.js"></script>
    {{--<script src="/js/visualization/sales_area.js"></script>--}}

    <script src="/js/visualization/sex_count.js"></script>
    <script src="/js/visualization/customer_province.js"></script>
@endsection