@extends('layouts.admin.partials.application')
@section('css')
    <style>
        th {
            text-align: center;
        }

        table {
            text-align: center;
        }
    </style>
@stop
@section('content')
    <div class="admin-content">
        <div class="am-cf am-padding">
            <div class="am-fl am-cf">
                <strong class="am-text-primary am-text-lg">商品管理</strong> /
                <a href="{{route('admin.comment.index')}}"><small>用户评论</small></a>
            </div>
        </div>

        @include('layouts._message')

        <div class="am-g">

            <form class="" action="/admin/brand/search" method="get">
                <div class="am-u-sm-12 am-u-md-3">
                    <div class="am-input-group am-input-group-sm">
                        <input type="text" class="am-form-field" name="keyword">
                    <span class="am-input-group-btn">
                        <button class="am-btn am-btn-default" type="submit">搜索</button>
                    </span>
                    </div>
                </div>
            </form>

        </div>

        <div class="am-g">
            <div class="am-u-sm-12">
                <form class="am-form">
                    <table class="am-table am-table-striped am-table-hover table-main">
                        <thead>
                        <tr>
                            <th>编号</th>
                            <th>商品</th>
                            <th>会员昵称</th>
                            <th class="am-hide-sm-only">评论内容</th>
                            <th class="am-hide-sm-only">评论时间</th>
                            <th class="am-hide-sm-only">是否回复</th>
                            <th class="table-set">操作</th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach($comments as $comment)
                            <tr>
                                <td>{{ $comment->id }}</td>
                                <td class="brand_logo">
                                    <img class="am-img-thumbnail am-img-bdrs am-radius" src="{{ $comment->good->image }}" alt="" class="am-radius"/>

                                    <div class="gallery-title">{{$comment->good->name }}</div>
                                </td>
                                <td>
                                    {{$comment->user->nickname }}
                                </td>
                                <td class="am-hide-sm-only">{{ str_limit($comment->content, 42) }}</td>
                                <td class="am-hide-sm-only">{{ $comment->created_at }}</td>

                                <td class="am-hide-sm-only">
                                    @if($comment->reply)
                                        <span class="am-icon-check"></span>
                                    @else
                                        <span class="am-icon-close"></span>
                                    @endif
                                </td>

                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a class="am-btn am-btn-default am-btn-xs am-text-secondary" href="{{ route('admin.comment.show', $comment->id) }}">
                                                <span class="am-icon-info"></span> 查看
                                            </a>
                                            <a class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" href="{{ route('admin.comment.destroy', $comment->id) }}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="确定删除吗？">
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
                        <div class="am-fr">
                            {!! $comments->render() !!}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
