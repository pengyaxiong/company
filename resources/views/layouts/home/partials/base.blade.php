<!doctype html>
<html class="no-js fixed-layout">
<head lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$config->title}}</title>
    <meta name="description" content="@yield('pageDesc')">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="icon" type="image/png" href="/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <link type="text/css" rel="stylesheet" href="/home/css/reset.css" media="all"/>
    <link type="text/css" rel="stylesheet" href="/home/css/common.css" media="all"/>
    @yield('css')
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，{{$config->title}}管理系统 暂不支持。 请 <a href="http://browsehappy.com/"
                                                                                      target="_blank">升级浏览器</a>
    以获得更好的体验！</p>
<![endif]-->
<!--SEO start-->
<h1 class="hidden"></h1>
<h2 class="hidden"></h2>
<!--SEO start-->
<div id="wrap">
    <div id="wrap1">

        <!-- header start -->
    @include("layouts.home.partials._header")
    <!-- header end -->

        <!-- content start -->
    @yield('content')
    <!-- content end -->

        <!-- footer start -->
    @include("layouts.home.partials._footer")
    <!-- footer end -->

    </div>
</div>
<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="/js/jquery-3.1.0.min.js"></script>
<!--<![endif]-->
<script charset="utf-8" src="/home/js/jquery.slides.js"></script>
<script charset="utf-8" src="/home/js/common.js"></script>
@yield('js')
</body>
</html>
