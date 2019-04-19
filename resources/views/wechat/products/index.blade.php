@extends('wechat.layouts.application')

@section('content')
    <div class="page-list" data-log="商品列表">

        <ol class="version">

            @foreach($products as $product)
                <li>
                    <a class="version-item" href="/wechat/product/{{$product->id}}">
                        <div class="version-item-img">
                            <img src="{{env('QINIU_IMAGES_LINK').$product->photo->identifier}}">
                        </div>
                        <div class="version-item-intro">
                            <div class="version-item-name"><p>{{$product->name}}</p></div>
                            <div class="version-item-intro-price"><span>{{doubleval($product->price)}}元</span></div>
                        </div>
                    </a>
                </li>
            @endforeach

        </ol>

        @include('wechat.layouts._footer')

    </div>
@endsection
