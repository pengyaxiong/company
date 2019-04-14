@extends('layouts.admin.partials.application')
@section('css')

@endsection
@section('content')
    <div class="admin-content">
        <div class="admin-content-body">

            <div class="am-cf am-padding">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong> /
                    <small>{{Auth::id()==1?'数据统计':'欢迎'}}</small>
                </div>
            </div>

            @include("layouts.admin.partials._flash")
            <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
                <li><a href="javascript:void (0)" class="am-text-success"><span class="am-icon-btn am-icon-file-text"></span><br>推文访问<br>{!! see_num('article') !!}</a></li>
                <li><a href="javascript:void (0)" class="am-text-warning"><span class="am-icon-btn am-icon-book"></span><br>课程流量<br>{!! see_num('supermarket') !!}</a></li>
                <li><a href="javascript:void (0)" class="am-text-danger"><span class="am-icon-btn am-icon-recycle"></span><br>总访问量<br>{!! uv() !!}</a></li>
                <li><a href="javascript:void (0)" class="am-text-secondary"><span class="am-icon-btn am-icon-user-md"></span><br>注册用户<br>{{\App\Models\System\User::count()}}</a></li>
            </ul>
            <div class="am-g">
                <div class="am-u-sm-12">

                    <div id="statistics_article" style="width: 100%;height:400px;"></div>

                </div>
            </div>

            <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>

            <div class="am-g">
                <div class="am-u-sm-12">

                    <div id="statistics_customer" style="width: 100%;height:600px;"></div>

                </div>
            </div>
            @include('layouts.admin.partials._footer')
        </div>
    </div>
@endsection
@section('js')
    <script src="/vendor/echarts/echarts.min.js"></script>
    <script src="/vendor/echarts/macarons.js"></script>

    <script src="/js/visualization/statistics_customer.js"></script>
    <script src="/js/visualization/statistics_article.js"></script>
@endsection

