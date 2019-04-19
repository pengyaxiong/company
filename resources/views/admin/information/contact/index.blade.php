@extends('layouts.admin.partials.application')

@section('content')
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">App反馈列表</strong> /
                <small>Contacts List</small>
            </div>
        </div>
        @include('layouts.admin.partials._flash')

        <div class="am-g">
            <div class="am-u-sm-12 am-u-md-6">

            </div>

            <div class="am-u-sm-12 am-u-md-3">
                <form method="get">
                    <div class="am-input-group am-input-group-sm">
                        <input type="text" class="am-form-field" name="keyword" placeholder="联系姓名" value="{{Request::input('keyword')}}">
                        <span class="am-input-group-btn">
                            <button class="am-btn am-btn-default" type="submit">搜索</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>


        <div class="am-g">
            <div class="am-u-sm-12">
                <form class="am-form" id="form">
                    <table class="am-table am-table-striped am-table-hover table-main">
                        <thead>
                        <tr>
                            <th class="table-id">编号</th>
                            <th class="table-title">姓名</th>
                            <th class="table-url">昵称</th>
                            <th class="table-desc">手机号</th>
                            <th class="table-name">反馈</th>
                            <th class="table-name">反馈时间</th>
                            <th class="table-set">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($contacts as $contact)
                            <tr data-id="{{$contact->id}}">

                                <td>{{$contact->id}}</td>
                                <td>
                                    {{$contact->name}}
                                </td>

                                <td>{{$contact->nickname}}</td>

                                <td>{{$contact->mobile}}</td>

                                <td>{{$contact->contact}}</td>

                                <td>{!! time_format('Y-m-d H:m:s',$contact->created_at) !!}</td>

                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                               href="{{route('information.contact.destroy', $contact->id)}}"
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

                    共 {{$contacts->total()}} 条记录

                    <div class="am-cf">
                        <div class="am-fr">
                            {!! $contacts->links() !!}
                        </div>
                    </div>
                    <hr/>
                </form>
            </div>

        </div>

    </div>
@endsection

@section('js')
@endsection