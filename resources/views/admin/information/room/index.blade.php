@extends('layouts.admin.partials.application')

@section('content')
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">聊天室列表</strong> /
                <small>Room List</small>
            </div>
        </div>
        @include('layouts.admin.partials._flash')

        <div class="am-g">
            <div class="am-u-sm-12 am-u-md-6">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                        <a type="button" class="am-btn am-btn-default" href="{{route('information.room.create')}}">
                            <span class="am-icon-plus"></span> 新增
                        </a>

                        <button type="button" class="am-btn am-btn-default" id="destroy_checked">
                            <span class="am-icon-trash-o"></span> 删除
                        </button>

                        <a href="{{route('information.room.trash')}}" type="button" class="am-btn am-btn-default">
                            <span class="am-icon-trash"></span> 回收站
                        </a>
                    </div>
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
                            <th class="table-title">名称</th>
                            <th class="table-desc">描述信息</th>
                            <th class="table-set">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($rooms as $room)
                            <tr data-id="{{$room->id}}">
                                <td><input type="checkbox" value="{{$room->id}}" class="checked_id"
                                           name="checked_id[]"/></td>
                                <td>{{$room->id}}</td>
                                <td>
                                    {{$room->name}}
                                </td>

                                <td>{{$room->description}}</td>

                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a class="am-btn am-btn-default am-btn-xs am-text-secondary"
                                               href="{{route('information.room.edit', $room->id)}}">
                                                <span class="am-icon-pencil-square-o"></span> 编辑
                                            </a>

                                            <a class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                               href="{{route('information.room.destroy', $room->id)}}"
                                               data-method="delete" data-token="{{csrf_token()}}"
                                               data-confirm="确认删除吗?">
                                                <span class="am-icon-trash-o"></span> 删除
                                            </a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    共 {{$rooms->total()}} 条记录

                    <div class="am-cf">
                        <div class="am-fr">
                            {!! $rooms->links() !!}
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
                    url: "/information/room/destroy_checked",
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

        });
    </script>
@endsection