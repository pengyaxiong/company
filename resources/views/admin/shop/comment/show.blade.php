@extends('layouts.admin.partials.application')
@section('css')
    <style>
        .ds-inline-replybox {
            margin: 8px 0 2px 0;
            padding-left: 38px;
        }

        .ds-replybox {
            width: auto;
            font-size: 12px;
            z-index: 3;
            margin: 8px 0;
            padding: 0 0 0 60px;
            position: relative;
            _zoom: 1;
        }

        .ds-replybox .ds-avatar {
            position: absolute;
            top: 0;
            left: 0;
        }

        .ds-avatar img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            padding: 1px;
            background-color: #fff;
        }

        .ds-comment-body a {
            color: #777;
        }

        #ds-thread #ds-reset a {
            cursor: pointer;
            text-decoration: none;
            color: #777;
            background-color: transparent;
            -webkit-transition: color .15s linear;
            -moz-transition: color .15s linear;
            transition: color .15s linear;
        }

        .ds-avatar {
            box-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
            position: relative;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            background-color: #fff;
            float: left;
        }

        .ds-textarea-wrapper {
            background-image: none;
            border-top-right-radius: 2px;
            border-top-left-radius: 2px;
            border-color: #ddd;
        }

        .ds-textarea-wrapper {
            position: relative;
            border: 1px solid #ccc;
            border-bottom: none;
            padding-right: 20px;
            overflow: hidden;
        }

        .ds-post-toolbar {
            position: relative;
            width: 100%;
            box-shadow: 0 1px 0 rgba(255, 255, 255, 0.6);
        }

        .ds-post-options {
            border-bottom-left-radius: 2px;
            border-color: #ddd;
            height: 36px;
        }

        .ds-post-button {
            border-bottom-right-radius: 2px;
            background: #3bb4f2;
            color: #fff;
            text-shadow: none;
            box-shadow: none;
            border: 1px solid #ddd;
            height: 36px;

            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            position: absolute;
            right: 0;
            top: 0;
            width: 100px;
            text-align: center;
            font-size: 14px;
            font-weight: bold;

        }

        .ds-post-options {
            position: relative;
            margin-right: 100px;
            height: 36px;
            border: 1px solid #ccc;
            border-right: none;
            border-bottom-left-radius: 3px;
            -webkit-border-bottom-left-radius: 3px;
        }

        .ds-gradient-bg {
            background: #f8f8f8;
        }

        .ds-toolbar-buttons {
            top: 8px;
            left: 10px;
        }

        .ds-textarea-wrapper textarea {
            display: block;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 13px;
            line-height: 20px;
            border: none;
            box-shadow: none;
            -webkit-appearance: none;
            overflow: auto;
            padding: 10px;
            height: 104px;
            margin: 0;
            resize: none;
            width: 100%;
            outline: none;

        }
    </style>
@stop
@section('content')
    <div class="admin-content">
        <div class="am-cf am-padding">
            <div class="am-fl am-cf">
                <strong class="am-text-primary am-text-lg">商品管理</strong> /
                <a href="{{route('admin.comment.index')}}">
                    <small>用户评论</small>
                </a>
            </div>
        </div>

        @include('layouts._message')

        <div class="am-g">
            <div class="am-u-sm-12 ">
                <div class="am-comments-list">

                    <article class="am-comment">
                        <a href="#link-to-user-home">
                            <img src="{{$comment->user->headimgurl}}" alt="" class="am-comment-avatar" width="48" height="48"/>
                        </a>

                        <div class="am-comment-main">
                            <header class="am-comment-hd">
                                <!--<h3 class="am-comment-title">评论标题</h3>-->
                                <div class="am-comment-meta">
                                    <a href="#link-to-user" class="am-comment-author">{{$comment->user->nickname}}</a>
                                    于 {{$comment->created_at}} 对 {{$comment->good->name}} 发表评论
                                </div>
                            </header>

                            <div class="am-comment-bd">
                                {{$comment->content}}
                            </div>
                        </div>
                    </article>


                    @if($comment->reply)
                        <article class="am-comment am-comment-flip am-comment-success">
                            <a href="javascript:void(0);" target="_blank">
                                <img src="{{ $admin->avatar }}" alt="" class="am-comment-avatar" width="48" height="48"/>
                            </a>

                            <div class="am-comment-main">
                                <header class="am-comment-hd">
                                    <!--<h3 class="am-comment-title">评论标题</h3>-->
                                    <div class="am-comment-meta">
                                        <a href="javascript:void(0);" class="am-comment-author">管理员 {{ $admin->name }}</a>
                                        于 {{$comment->updated_at}} 对 {{$comment->user->nickname}} 发表评论
                                    </div>
                                </header>

                                <div class="am-comment-bd">
                                    {{$comment->reply}}
                                </div>
                            </div>
                        </article>
                    @endif
                </div>

                <hr>
                <div class="ds-replybox ds-inline-replybox" style="display: block;">
                    <a class="ds-avatar" href="javascript:void(0);">
                        <img src="{{ $admin->avatar }}" alt="">
                    </a>

                    <form method="post" action="{{route('admin.comment.reply', $comment->id)}}">
                        {{ csrf_field() }}
                        {!! method_field('patch') !!}

                        <div class="ds-textarea-wrapper ds-rounded-top">
                            <textarea name="reply" placeholder="说点什么吧…"></textarea>
                        </div>
                        <div class="ds-post-toolbar">
                            <div class="ds-post-options ds-gradient-bg"><span class="ds-sync"></span></div>
                            <button class="ds-post-button am-btn am-btn-secondary" type="submit">发布</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop