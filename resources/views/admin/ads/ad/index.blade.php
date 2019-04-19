@extends('layouts.admin.partials.application')

@section('content')
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">广告列表</strong> /
                <small>Ad List</small>
            </div>
        </div>
        @include('layouts.admin.partials._flash')

        <div class="am-g">
            <div class="am-u-sm-12 am-u-md-6">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                        <a type="button" class="am-btn am-btn-default" href="{{route('ads.ad.create')}}">
                            <span class="am-icon-plus"></span> 新增
                        </a>

                        <button type="button" class="am-btn am-btn-default" id="destroy_checked">
                            <span class="am-icon-trash-o"></span> 删除
                        </button>

                        <a  href="{{route('ads.ad.trash')}}" type="button" class="am-btn am-btn-default">
                            <span class="am-icon-trash"></span> 回收站
                        </a>
                    </div>
                </div>
            </div>
            <div class="am-u-sm-12 am-u-md-3">
                <div class="am-form-group">
                    <select data-am-selected="{btnWidth: '80%',  btnStyle: 'secondary', btnSize: 'sm', maxHeight: 360, searchBox: 1}"
                            name="category_id" id="change_category">
                        <option value="-1">所有分类</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                    @if($category->id == Request::input('category_id')) selected @endif>
                                {!! indent_category($category->count) !!}{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>

        <div class="am-g">
            <div class="am-u-sm-12">
                <form class="am-form" id="form">
                    <table class="am-table am-table-striped am-table-hover table-main">
                        <thead>
                        <tr>
                            <th class="table-check"><input type="checkbox" id="checked"/></th>
                            <th class="table-id">编号</th>
                            <th>缩略图</th>
                            <th class="table-title">标题</th>
                            <th class="table-category">所属栏目</th>
                            <th class="table-desc">描述信息</th>
                            <th class="table-sort-order am-hide-sm-only" style="width:10%">排序</th>
                            <th class="table-date am-hide-sm-only">发布日期</th>
                            <th class="table-set">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($ads as $ad)
                            <tr data-id="{{$ad->id}}">
                                <td><input type="checkbox" value="{{$ad->id}}" class="checked_id"
                                           name="checked_id[]"/></td>
                                <td>{{$ad->id}}</td>
                                <td>
                                    {!! thumb_url($ad, ['class'=>'thumb']) !!}
                                </td>
                                <td>
                                    {{$ad->title}}
                                </td>

                                <td>{{$ad->category->name}}</td>

                                <td>{{$ad->description}}</td>

                                <td class="am-hide-sm-only">
                                    <input type="text" name="sort_order" class="am-input-sm"
                                           value="{{$ad->sort_order}}">
                                </td>

                                <td class="am-hide-sm-only">
                                    {{$ad->created_at}}
                                </td>

                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a class="am-btn am-btn-default am-btn-xs am-text-secondary"
                                               href="{{route('ads.ad.edit', $ad->id)}}">
                                                <span class="am-icon-pencil-square-o"></span> 编辑
                                            </a>

                                            <a class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                               href="{{route('ads.ad.destroy', $ad->id)}}"
                                               data-method="delete" data-token="{{csrf_token()}}" data-confirm="确认删除吗?">
                                                <span class="am-icon-trash-o"></span> 删除
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    共 {{$ads->total()}} 条记录

                    <div class="am-cf">
                        <div class="am-fr">
                            {!! $ads->links() !!}
                        </div>
                    </div>
                    <hr/>
                </form>
            </div>

        </div>

    </div>
@endsection

@section('js')
    <script>
        $(function () {
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
                    url: "/ads/ad/destroy_checked",
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

            //排序
            $("input[name='sort_order']").change(function () {
                var data = {
                    sort_order: $(this).val(),
                    id: $(this).parents("tr").data('id')
                };

                $.ajax({
                    type: "PATCH",
                    url: "/ads/ad/sort_order",
                    data: data,
                    success: function (data) {
                        if (data.status == 0) {
                            alert(data.msg);
                            return false;
                        }
                    }
                });
            });

            //切换栏目
            $("#change_category").change(function () {
                var category_id = $(this).val();
                if (category_id == "-1") {
                    location.href = "{{route('ads.ad.index')}}";
                    return false;
                }
                var url = "/ads/ad?category_id=" + category_id;
                location.href = url;
            })
        });
    </script>
@endsection