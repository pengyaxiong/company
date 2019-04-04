@extends('layouts.admin.partials.application')
@section('css')
    <link rel="stylesheet" media="screen" href="/vendor/particles/css/style.css">
    <style>
        #particles-js {
            background-image: url('/vendor/particles/timg.jpg?{!! get_millisecond() !!}');
        }
    </style>
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

            @if (Auth::id()<1)
                <div class="am-g">
                    <div class="am-u-sm-12">

                        <div id="statistics_user" style="width: 100%;height:400px;"></div>

                    </div>
                </div>

                <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>

                <div class="am-g">
                    <div class="am-u-sm-12">

                        <div id="statistics_flow" style="width: 100%;height:600px;"></div>

                    </div>
                </div>
            @else
                <div class="am-g">
                    <div class="am-u-sm-12">
                        <div id="particles-js">
                            <p>
                                {{$bibel['cn']}}
                                <br/>
                                {{$bibel['en']}}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
            @include('layouts.admin.partials._footer')
        </div>
    </div>
@endsection
@section('js')
    <script src="/vendor/particles/js/particles.js"></script>
    <script src="/vendor/particles/js/app.js"></script>
@endsection

