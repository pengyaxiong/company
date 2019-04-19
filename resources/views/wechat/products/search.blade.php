@extends('wechat.layouts.application')

@section('content')
    <div class="page-search" data-log="搜索页">
        <div class="header">
            <div class="left">
                <a href="/wechat/" title="Holy商城" data-log="HEAD-首页" class="home">
                    <span class="icon-home icon"></span>
                </a>
            </div>
            <div class="tit">
                <div class="searchword"><input autofocus="autofocus"></div>
            </div>
            <div class="searchlabel">
                <a>
                    <span class="icon icon-search"></span>
                </a>
            </div>
        </div>
        <div>
            <ul class="list-default">

                @foreach ($products as $p)
                    <li @if($p->is_top == '1')class="top" @endif onclick="location.href='/wechat/product/{{$p->id}}'">
                        <span>{{$p->name}}</span>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $(".icon-search").click(function () {
                var searchword = $.trim($(".searchword input").val());
                location.href = '/wechat/product?searchword=' + searchword;
            });
        })
    </script>
@endsection