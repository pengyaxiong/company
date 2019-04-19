@extends('layouts.admin.partials.application')
@section('content')
    <div class="admin-content">
        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">商品品牌</strong> /
                <small>Good Brands</small>
            </div>
        </div>

        @include('layouts.admin.partials._flash')

        <div class="am-g">
            <div class="am-u-sm-12 am-u-md-6">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                        <a class="am-btn am-btn-default" href="{{ route('shop.brand.create') }}">
                            <span class="am-icon-plus"></span> 新增
                        </a>
                    </div>
                </div>
            </div>

            <div class="am-u-sm-12 am-u-md-3">
                <form method="get">
                    <div class="am-input-group am-input-group-sm">
                        <input type="text" class="am-form-field" name="keyword" value="{{Request::input('keyword')}}">
                        <span class="am-input-group-btn">
                            <button class="am-btn am-btn-default" type="submit">搜索</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <div class="am-g">
            <div class="am-u-sm-12">
                <form class="am-form">
                    <table class="am-table am-table-striped am-table-hover table-main">
                        <thead>
                        <tr>
                            {{--<th class="table-check"><input type="checkbox"/></th>--}}
                            <th class="table-id">ID</th>
                            <th class="table-thumb">缩略图</th>
                            <th class="table-name">品牌名称</th>
                            <th>品牌商品</th>
                            <th class="table-desc">品牌描述</th>
                            <th class="table-is-show am-hide-sm-only">是否显示</th>
                            <th class="table-sort-order am-hide-sm-only" style="width:10%">排序</th>
                            <th class="table-set">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($brands as $brand)
                            <tr data-id="{{$brand->id}}">
                                <td>{{$brand->id}}</td>
                                <td>
                                    {!! thumb_url($brand, ['class'=>'thumb']) !!}
                                </td>
                                <td><a href="{{$brand->url}}" target="_blank">{{$brand->name}}</a></td>

                                <td>
                                    {!! show_brand_products($brand) !!}
                                </td>
                                <td style="text-overflow:ellipsis;width: 30%;">
                                    <div style="  width:100%;height:3em;overflow:hidden;">
                                        {{$brand->description}}
                                    </div>
                                </td>
                                <td class="am-hide-sm-only">
                                    {!! is_something('is_show', $brand) !!}
                                </td>

                                <td class="am-hide-sm-only">
                                    <input type="text" name="sort_order" class="am-input-sm"
                                           value="{{$brand->sort_order}}">
                                </td>


                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a class="am-btn am-btn-default am-btn-xs am-text-secondary"
                                               href="{{route('shop.brand.edit', $brand->id)}}">
                                                <span class="am-icon-pencil-square-o"></span> 编辑
                                            </a>

                                            <a class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                               href="{{route('shop.brand.destroy', $brand->id)}}" data-method="delete"
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

                    <div class="am-cf">
                        共 {{$brands->total()}} 条记录
                        <div class="am-fr">
                            {!! $brands->appends(Request::all())->links() !!}
                        </div>
                    </div>
                    <hr/>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(function () {

            //排序
            $("input[name='sort_order']").change(function () {
                var data = {
                    sort_order: $(this).val(),
                    id: $(this).parents("tr").data('id')
                }
                $.ajax({
                    type: "PATCH",
                    url: "/shop/brand/sort_order",
                    data: data
                });
            })

            //是否...
            $(".is_something").click(function () {
                var _this = $(this);
                var data = {
                    id: _this.parents("tr").data('id'),
                    attr: _this.data('attr')
                }

                $.ajax({
                    type: "PATCH",
                    url: "/shop/brand/is_something",
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
        });
    </script>
@endsection