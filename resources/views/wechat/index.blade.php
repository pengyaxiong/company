@extends('wechat.layouts.application')

@section('content')
    <div class="page-index" id="home" data-log="首页">
        <div class="index-header">
            <div class="search_bar">
                <a href="/wechat/search">
                    <span class="icon icon-search"></span>
                    <span class="text">搜索商品名称</span>
                </a>
            </div>
            <div class="search_bottom"></div>
        </div>

        <!--焦点图-->
        <section class="slider">
            <div class="flexslider">
                <ul class="slides">

                    @foreach($slides as $slide)
                        <li>
                            <a href="{{$slide->url}}"><img src="{{env('QINIU_IMAGES_LINK').$slide->photo->identifier}}"/></a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <!--推荐商品-->
        <div class="list">
            <div class="section">
                <div class="mcells_auto_fill">
                    <div class="body">

                        @foreach($banners as $banner)
                            <div>
                                <div class="items">
                                    <a href="{{$banner->url}}"><img src="{{env('QINIU_IMAGES_LINK').$banner->photo->identifier}}"></a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

            @foreach($products as $product)
                <div class="section" onclick="location.href='/wechat/product/{{$product->id}}'">
                    <div>
                        <div class="item">
                            <div class="img">
                                <img class="ico" src="{{env('QINIU_IMAGES_LINK').$product->photo->identifier}}" width="90px;" height="70px;">
                                @if($product->is_new)
                                    <img class="tag " src="/vendor/wechat/images/new.png">
                                @elseif($product->is_hot)
                                    <img class="tag " src="/vendor/wechat/images/hot.png">
                                @endif
                            </div>
                            <div class="info">
                                <div class="name"><p>{{$product->name}}</p></div>
                                <div class="brief"><p>{{$product->description}}</p></div>
                                <div class="price"><p>{{$product->price}}元 起</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        @include('wechat.layouts._footer')

    </div>
@endsection

@section('js')
    <script defer src="/vendor/wechat/flexslider/jquery.flexslider.js"></script>
    <script>
        $(window).load(function () {
            $('.flexslider').flexslider({
                animation: "slide",
                directionNav: false
            });
        });
    </script>
@endsection