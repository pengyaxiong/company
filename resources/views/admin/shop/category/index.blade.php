@extends('layouts.admin.partials.application')
@section('content')
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">商品分类管理</strong> /
                <small>Product Categories Manage</small>
            </div>
        </div>


        @include('layouts.admin.partials._flash')

        <div class="am-g">
            <div class="am-u-sm-12 am-u-md-6">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                        <a type="button" class="am-btn am-btn-default" href="{{route('shop.category.create')}}">
                            <span class="am-icon-plus"></span> 新增
                        </a>
                        <button type="button" class="am-btn am-btn-success" id="show_all"
                                href="{{route('shop.category.create')}}">
                            <span class="am-icon-arrows-alt"></span> 展开所有
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="am-g">
            <div class="am-u-sm-12">
                <form class="am-form">
                    <table class="am-table  am-table-hover table-main">
                        <thead>
                        <tr>
                            <th class="table-id">编号</th>
                            <th>缩略图</th>
                            <th class="table-name" style="width: 20%;">分类名</th>
                            <th style="width: 20%;">分类商品</th>
                            <th class="table-is-show am-hide-sm-only">是否显示</th>
                            <th class="table-sort-order am-hide-sm-only" style="width:10%">排序</th>
                            <th class="table-set">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                            <tr data-id="{{$category->id}}" id="row_{{$category->id}}" class="xParent">
                                <td>{{$category->id}}</td>
                                <td>
                                    {!! thumb_url($category) !!}
                                </td>
                                <td>
                                    {{$category->name}}
                                </td>

                                <td>
                                    {!! show_category_products($category) !!}
                                </td>

                                <td class="am-hide-sm-only">
                                    {!! is_something('is_show', $category) !!}
                                </td>

                                <td class="am-hide-sm-only">
                                    <input type="text" name="sort_order" class="am-input-sm"
                                           value="{{$category->sort_order}}">
                                </td>


                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a class="am-btn am-btn-default am-btn-xs am-text-secondary"
                                               href="{{route('shop.category.edit', $category->id)}}">
                                                <span class="am-icon-pencil-square-o"></span> 编辑
                                            </a>

                                            <a class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                               href="{{route('shop.category.destroy', $category->id)}}"
                                               data-method="delete"
                                               data-token="{{csrf_token()}}" data-confirm="确认删除吗?">
                                                <span class="am-icon-trash-o"></span> 删除
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @foreach ($category->children as $c)
                                <tr data-id="{{$c->id}}" class="xChildren child_row_{{$category->id}}">
                                    <td>{{$c->id}}</td>
                                    <td>
                                    {!! thumb_url($c, ['class'=>'thumb']) !!}
                                    <td>
                                        {!! indent_category(2) !!}
                                        {{$c->name}}
                                    </td>

                                    <td>
                                        {!! show_category_products($c) !!}
                                    </td>

                                    <td class="am-hide-sm-only">
                                        {!! is_something('is_show', $c) !!}
                                    </td>

                                    <td class="am-hide-sm-only">
                                        <input type="text" name="sort_order" class="am-input-sm"
                                               value="{{$c->sort_order}}">
                                    </td>

                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a class="am-btn am-btn-default am-btn-xs am-text-secondary"
                                                   href="{{route('shop.category.edit', $c->id)}}">
                                                    <span class="am-icon-pencil-square-o"></span> 编辑
                                                </a>

                                                <a class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                                   href="{{route('shop.category.destroy', $c->id)}}"
                                                   data-method="delete"
                                                   data-token="{{csrf_token()}}" data-confirm="确认删除吗?">
                                                    <span class="am-icon-trash-o"></span> 删除
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>


                </form>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            //排序
            $("input[name='sort_order']").change(function () {
                var data = {
                    sort_order: $(this).val(),
                    id: $(this).parents("tr").data('id')
                };

                $.ajax({
                    type: "PATCH",
                    url: "/shop/category/sort_order",
                    data: data,

                    success: function (data) {
                        if (data.status == 0) {
                            alert(data.msg);
                            return false;
                        }
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
                    url: "/shop/category/is_something",
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

            //展开与折叠表格
            $("tr.xParent").dblclick(function () {
                $(this).toggleClass('am-active');
                $(".child_" + this.id).toggle();
            });

            $("#show_all").click(function () {
                $("tr.xParent").toggleClass('am-active');
                $("tr.xChildren").toggle();
            });
        });
    </script>
@endsection