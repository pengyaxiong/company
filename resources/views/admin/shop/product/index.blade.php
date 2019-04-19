@extends('layouts.admin.partials.application')
@section('css')
    <link rel="stylesheet" href="/vendor/daterangepicker/daterangepicker.css">
    <style>
        .thumb {
            max-height: 60px;
        }

    </style>
@endsection
@section('content')
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">商品列表</strong> /
                <small>Product List</small>
            </div>
        </div>

        @include('layouts.admin.partials._flash')

        <div class="am-g" style="height: 37px;">
            <div class="am-u-sm-12 am-u-md-3">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                        <a type="button" class="am-btn am-btn-default" href="{{route('shop.product.create')}}">
                            <span class="am-icon-plus"></span> 新增
                        </a>
                        <button type="button" class="am-btn am-btn-default" id="destroy_checked">
                            <span class="am-icon-trash-o"></span> 删除
                        </button>
                        <a type="button" class="am-btn am-btn-default" href="{{route('shop.product.trash')}}">
                            <span class="am-icon-trash"></span> 回收站
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="am-g">
            <div class="am-u-sm-12 am-u-md-12">
                <form class="am-form-inline" role="form" method="get">

                    <div class="am-form-group">
                        <input type="text" name="name" class="am-form-field am-input-sm" placeholder="商品名" value="{{ Request::input('name') }}">
                    </div>

                    <div class="am-form-group">
                        <select data-am-selected="{btnSize: 'sm', maxHeight: 360, searchBox: 1}"
                                name="category_id" id="change_category">
                            <optgroup label="请选择">
                                <option value="-1">所有分类</option>
                            </optgroup>

                            @foreach ($filter_categories as $category)
                                <optgroup label="{{$category->name}}">
                                    @foreach ($category->children as $c)
                                        <option value="{{$c->id}}" @if($c->id == Request::input('category_id')) selected @endif>
                                            {{$c->name}}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>

                    <div class="am-form-group">
                        <select data-am-selected="{btnSize: 'sm', maxHeight: 360, searchBox: 1}"
                                name="brand_id" id="">
                            <option value="-1">所有品牌</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" @if($brand->id == Request::input('brand_id')) selected @endif>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="am-form-group">
                        <div class="am-btn-group" data-am-button="">
                            <label class="am-btn am-btn-default am-btn-sm am-radius @if(Request::input('is_top') == 1) am-active @endif">
                                <input type="checkbox" name="is_top" value="1" @if(Request::input('is_top') == 1) checked @endif>
                                置顶
                            </label>
                            <label class="am-btn am-btn-default am-btn-sm am-radius @if(Request::input('is_recommend') == 1) am-active @endif">
                                <input type="checkbox" name="is_recommend" value="1" @if(Request::input('is_recommend') == 1) checked @endif>
                                推荐
                            </label>
                            <label class="am-btn am-btn-default am-btn-sm am-radius @if(Request::input('is_hot') == 1) am-active @endif">
                                <input type="checkbox" name="is_hot" value="1" @if(Request::input('is_hot') == 1) checked @endif>
                                热销
                            </label>
                            <label class="am-btn am-btn-default am-btn-sm am-radius @if(Request::input('is_new') == 1) am-active @endif">
                                <input type="checkbox" name="is_new" value="1" @if(Request::input('is_new') == 1) checked @endif>
                                新品
                            </label>
                        </div>
                    </div>

                    <div class="am-form-group">
                        <select data-am-selected="{btnSize: 'sm'}" name="is_onsale" id="">
                            <option value="-1" @if(Request::input('is_onsale') == '-1') selected @endif>上架状态</option>
                            <option value="1" @if(Request::input('is_onsale') == '1') selected @endif>上架</option>
                            <option value="0" @if(Request::input('is_onsale') == '0') selected @endif>下架</option>
                        </select>
                    </div>

                    <div class="am-form-group">
                        <input type="text" id="created_at" placeholder="选择时间日期" name="created_at"
                               value="{{ Request::input('created_at') }}" class="am-form-field am-input-sm"/>
                    </div>

                    <button type="submit" class="am-btn am-btn-default am-btn-sm">查询</button>
                </form>
            </div>
        </div>


        <div class="am-g">
            <div class="am-u-sm-12">
                <form class="am-form" id="form">
                    <table class="am-table am-table-striped am-table-hover table-main">
                        <thead>
                        <tr>
                            <th class="table-check"><input type="checkbox" id="checked"/></th>
                            <th class="table-id">ID</th>
                            <th class="table-thumb">缩略图</th>
                            <th class="table-title">商品名称</th>
                            <th class="table-category">所属分类</th>
                            <th class="table-brand">品牌</th>
                            <th class="table-price">单价</th>
                            <th class="am-hide-sm-only">上架</th>
                            <th class="am-hide-sm-only">置顶</th>
                            <th class="am-hide-sm-only">推荐</th>
                            <th class="am-hide-sm-only">热销</th>
                            <th class="am-hide-sm-only">新品</th>
                            <th class="am-hide-sm-only" style="width:10%">库存</th>
                            <th class="table-date am-hide-sm-only">上架日期</th>

                            <th class="table-set">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            <tr data-id="{{$product->id}}">
                                <td><input type="checkbox" value="{{$product->id}}" class="checked_id"
                                           name="checked_id[]"/></td>
                                <td>{{$product->id}}</td>
                                <td>
                                    {!! image_url($product, ['class'=>'thumb']) !!}
                                </td>
                                <td>
                                    {{$product->name}}
                                </td>

                                <td>
                                    {{ $product->categories->implode('name', ', ') }}
                                </td>

                                <td>
                                    {{$product->brand->name or ''}}
                                </td>

                                <td>
                                    <span class="am-icon-rmb"> {{$product->price}}</span>
                                </td>

                                @foreach (array('is_onsale', 'is_top', 'is_recommend', 'is_hot', 'is_new') as $attr)
                                    <td class="am-hide-sm-only">
                                        {!! is_something($attr, $product) !!}
                                    </td>
                                @endforeach


                                <td class="am-hide-sm-only">
                                    <input type="text" name="stock" class="am-input-sm" value="{{$product->stock}}">
                                </td>

                                <td class="am-hide-sm-only">
                                    {{$product->created_at->format("Y-m-d H:i")}}
                                </td>

                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a class="am-btn am-btn-default am-btn-xs am-text-secondary"
                                               href="{{route('shop.product.edit', $product->id)}}">
                                                <span class="am-icon-pencil-square-o"></span> 编辑
                                            </a>

                                            <a class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                               href="{{route('shop.product.destroy', $product->id)}}"
                                               data-method="delete"
                                               data-token="{{csrf_token()}}" data-confirm="确认删除吗?">
                                                <span class="am-icon-trash-o"></span> 删除
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    共 {{$products->total()}} 条记录

                    <div class="am-cf">
                        <div class="am-fr">
                            {!! $products->appends(Request::all())->links() !!}
                        </div>
                    </div>
                    <hr/>
                </form>
            </div>

        </div>

    </div>
@endsection

@section('js')
    <script src="/vendor/daterangepicker/moment.js"></script>
    <script src="/vendor/moment/locale/zh-cn.js"></script>
    <script src="/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="/js/daterange_config.js"></script>
    <script>
        $(function () {
            //库存
            $("input[name='stock']").change(function () {
                var stock = $(this).val() == '无限' ? '-1' : $(this).val();
                var data = {
                    stock: stock,
                    id: $(this).parents("tr").data('id')
                }

                $.ajax({
                    type: "PATCH",
                    url: "/shop/product/change_stock",
                    data: data,
                    success: function (data) {
                        if (data.status == 0) {
                            alert(data.msg);
                            return false;
                        }
                    }
                });
            })


            //删除所选
            $('#destroy_checked').click(function () {
                var length = $(".checked_id:checked").length;
                if (length == 0) {
                    alert("您必须至少选中一条!");
                    return false;
                }
                var checked_id = $(".checked_id:checked").serialize();

                $.ajax({
                    type: "DELETE",
                    url: "/shop/product/destroy_checked",
                    data: checked_id,
                    success: function (data) {
                        if (data.status == 0) {
                            alert(data.msg);
                            return false;
                        }
                        location.href = location.href;
                    }
                });
            });

            //是否...
            $(".is_something").click(function () {
                var _this = $(this);
                var data = {
                    id: _this.parents("tr").data('id'),
                    attr: _this.data('attr')
                }

                $.ajax({
                    type: "PATCH",
                    url: "/shop/product/is_something",
                    data: data,
                    success: function (data) {
                        if (data.status == 0) {
                            alert(data.msg);
                            return false;
                        }
                        _this.toggleClass('am-icon-close am-icon-check');
                    }
                });
            });

            //切换栏目
            $("#change_category").change(function () {
                var category_id = $(this).val();
                if (category_id == "-1") {
                    location.href = "{{route('shop.product.index')}}";
                    return false;
                }
                var url = "/shop/product?category_id=" + category_id;
                location.href = url;
            })
        });
    </script>
@endsection