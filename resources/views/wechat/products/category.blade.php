@extends('wechat.layouts.application')

@section('content')
    <div class="page-category" data-log="商品分类">

        <div class="page-category-wrap">

            @foreach($categories as $category)
                <div class="list-wrap" id="m0">
                    <h3 class="list_title">{{$category->name}}</h3>
                    <ol class="list_category">
                        @foreach($category->children as $child)
                            <li onclick="location.href='/wechat/product?category_id={{$child->id}}'">
                                <div class="img"><img src="{{env('QINIU_IMAGES_LINK').$child->photo->identifier}}"></div>
                                <div class="name"><span>{{$child->name}}</span></div>
                            </li>
                        @endforeach
                    </ol>
                </div>
            @endforeach

        </div>


        @include('wechat.layouts._footer')

    </div>
@endsection