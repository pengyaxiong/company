@extends('layouts.admin.partials.application')

@section('css')
    <link rel="stylesheet" href="/vendor/markdown/css/editormd.min.css"/>
    <link rel="stylesheet" href="/vendor/webupload/dist/webuploader.css"/>
    <link rel="stylesheet" type="text/css" href="/vendor/webupload/style.css"/>
@endsection
@section('content')
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">编辑商品</strong> /
                <small>Edit Product</small>
            </div>
        </div>

        @include('layouts.admin.partials._flash')

        <div class="am-g">
            <div class="am-u-sm-12 am-u-md-12">


                <form class="am-form" action="{{ route('shop.product.update', $product->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}


                    <div class="am-tabs am-margin" data-am-tabs>
                        <ul class="am-tabs-nav am-nav am-nav-tabs">
                            <li class="am-active"><a href="#tab1">通用信息</a></li>
                            <li><a href="#tab2">商品介绍</a></li>
                            <li><a href="#tab3">商品相册</a></li>
                        </ul>

                        <div class="am-tabs-bd">
                            <div class="am-tab-panel am-fade am-in am-active" id="tab1">

                                <div class="am-g am-margin-top">
                                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                        所属栏目
                                    </div>
                                    <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">

                                        <select multiple
                                                data-am-selected="{btnWidth: '100%',  btnStyle: 'secondary', btnSize: 'sm', maxHeight: 360, searchBox: 1}"
                                                name="category_id[]">

                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}"
                                                        @if($p_categories->contains($category->id)) selected @endif>
                                                    {{$category->name}}
                                                </option>

                                                @foreach ($category->children as $c)
                                                    <option value="{{$c->id}}"
                                                            @if($p_categories->contains($c->id)) selected @endif>
                                                        {!! indent_category(1) !!}{{$c->name}}
                                                    </option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="am-g am-margin-top">
                                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                        商品名称
                                    </div>
                                    <div class="am-u-sm-8 am-u-md-4">
                                        <input type="text" class="am-input-sm" name="name" value="{{$product->name}}">
                                    </div>
                                    <div class="am-hide-sm-only am-u-md-6">*必填，不可重复</div>
                                </div>

                                <div class="am-g am-margin-top">
                                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                        单价
                                    </div>
                                    <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                        <input type="text" class="am-input-sm" name="price" value="{{$product->price}}">
                                    </div>
                                </div>

                                <div class="am-g am-margin-top">
                                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                        商品品牌
                                    </div>
                                    <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                        <select data-am-selected="{btnWidth: '100%',  btnStyle: 'secondary', btnSize: 'sm', maxHeight: 360, searchBox: 1}"
                                                name="brand_id">
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                        @if($brand->id == $product->brand_id) selected @endif>
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="am-g am-margin-top">
                                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                        库存
                                    </div>
                                    <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                        <input type="text" class="am-input-sm" name="stock"
                                               value="{{$product->stock}}">
                                    </div>
                                </div>

                                <div class="am-g am-margin-top">
                                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                        缩略图
                                    </div>

                                    <div class="am-u-sm-8 am-u-md-8 am-u-end col-end">
                                        <div class="am-form-group am-form-file new_thumb">
                                            <button type="button" class="am-btn am-btn-success am-btn-sm">
                                                <i class="am-icon-cloud-upload" id="loading"></i> 上传新的缩略图
                                            </button>
                                            <input type="file" id="image_upload">
                                            <input type="hidden" name="image" value="{{$product->photo->link}}">
                                        </div>

                                        <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>

                                        <div>
                                            {!! image_url($product->photo, ['id'=>'img_show']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="am-g am-margin-top sort">
                                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                        描述信息
                                    </div>
                                    <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                        <textarea rows="4" name="description">{{$product->description}}</textarea>
                                    </div>
                                </div>

                                <div class="am-g am-margin-top">
                                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                        上架
                                    </div>
                                    <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                        <label class="am-radio-inline">
                                            <input type="radio" value="1" name="is_onsale"
                                                   @if($product->is_onsale == 1) checked @endif> 是
                                        </label>
                                        <label class="am-radio-inline">
                                            <input type="radio" value="0" name="is_onsale"
                                                   @if($product->is_onsale == 0) checked @endif> 否
                                        </label>
                                    </div>
                                </div>

                                <div class="am-g am-margin-top">
                                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                        加入推荐
                                    </div>
                                    <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                        <input type="hidden" name="is_top" value="0">
                                        <input type="hidden" name="is_recommend" value="0">
                                        <input type="hidden" name="is_hot" value="0">
                                        <input type="hidden" name="is_new" value="0">

                                        <div class="am-btn-group" data-am-button="">
                                            <label class="am-btn am-btn-default am-btn-xs am-round @if($product->is_top == 1) am-active @endif">
                                                <input type="checkbox" name="is_top" value="1"
                                                       @if($product->is_top == 1) checked @endif> 置顶
                                            </label>
                                            <label class="am-btn am-btn-default am-btn-xs am-round @if($product->is_recommend == 1) am-active @endif">
                                                <input type="checkbox" name="is_recommend" value="1"
                                                       @if($product->is_recommend == 1) checked @endif> 推荐
                                            </label>
                                            <label class="am-btn am-btn-default am-btn-xs am-round @if($product->is_hot == 1) am-active @endif">
                                                <input type="checkbox" name="is_hot" value="1"
                                                       @if($product->is_hot == 1) checked @endif> 热销
                                            </label>
                                            <label class="am-btn am-btn-default am-btn-xs am-round @if($product->is_new == 1) am-active @endif">
                                                <input type="checkbox" name="is_new" value="1"
                                                       @if($product->is_new == 1) checked @endif> 新品
                                            </label>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="am-tab-panel am-fade" id="tab2">
                                <div class="am-g am-margin-top-sm">
                                    <div class="am-u-sm-12 am-u-md-12">
                                        <div id="markdown">
                                            <textarea rows="10" name="content"
                                                      style="display:none;">{!! $product->content !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="am-tab-panel am-fade" id="tab3">
                                <ul data-am-widget="gallery"
                                    class="am-gallery am-avg-sm-2 am-avg-md-4 am-avg-lg-6 am-gallery-imgbordered xGallery"
                                    data-am-gallery="{ pureview: true }">

                                    @foreach($product->product_galleries as $gallery)
                                        <li>
                                            <div class="am-gallery-item">
                                                <a href="{{$gallery->link}}" class="">
                                                    <img src="{{$gallery->link}}"/>
                                                </a>
                                                <div class="file-panel">
                                                    <span class="cancel" data-id="{{$gallery->id}}">删除</span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>


                                <div id="uploader">
                                    <div class="queueList">
                                        <div id="dndArea" class="placeholder">
                                            <div id="filePicker"></div>
                                            <p>或将照片拖到这里，单次最多可选300张</p>
                                        </div>
                                    </div>
                                    <div class="statusBar" style="display:none;">
                                        <div class="progress">
                                            <span class="text">0%</span>
                                            <span class="percentage"></span>
                                        </div>
                                        <div class="info"></div>
                                        <div class="btns">
                                            <div id="filePicker2"></div>
                                            <div class="uploadBtn">开始上传</div>
                                        </div>
                                    </div>

                                    <div id="imgs"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="am-margin">
                        <button type="submit" class="am-btn am-btn-primary am-radius">提交保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="/js/jquery.html5-fileupload.js"></script>
    <script src="/js/upload.js"></script>

    <script src="/vendor/markdown/editormd.min.js"></script>
    <script src="/js/editormd_config.js"></script>

    <script type="text/javascript" src="/vendor/webupload/dist/webuploader.js"></script>
    <script type="text/javascript" src="/vendor/webupload/upload.js"></script>

    <script>
        $(function () {
            $(".am-gallery-item").hover(function () {
                $(this).children('.file-panel').fadeIn(300);
            }, function () {
                $(this).children('.file-panel').fadeOut(300);
            });

            $(".cancel").click(function () {
                var _this = $(this);
                $.ajax({
                    type: "delete",
                    url: "/admin/shop/product/destroy_gallery",
                    data: {gallery_id: _this.data('id')},
                    success: function (data) {
                        if (data.status == 0) {
                            alert(data.msg);
                            return false;
                        }
                        _this.parents("li").remove();
                    }
                });
            });
        })
    </script>
@endsection