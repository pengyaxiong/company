@extends('layouts.admin.partials.application')
@section('content')
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">新增品牌</strong> /
                <small>Create A New Brand</small>
            </div>
        </div>

        @include('layouts.admin.partials._flash')

        <form class="am-form" action="{{ route('shop.brand.store') }}" method="post">
            {{ csrf_field() }}

            <div class="am-g am-margin-top">
                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                    商品品牌
                </div>
                <div class="am-u-sm-8 am-u-md-4">
                    <input type="text" class="am-input-sm" name="name" value="{{ old('name')}}">
                </div>
                <div class="am-hide-sm-only am-u-md-6">*必填，不可重复</div>
            </div>

            <div class="am-g am-margin-top">
                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                    品牌网址
                </div>
                <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                    <input type="text" class="am-input-sm" name="url" value="{{ old('url')}}">
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
                        <input type="hidden" name="image">
                    </div>

                    <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>

                    <div>
                        <img src="" id="img_show" style="max-height: 200px;">
                    </div>
                </div>
            </div>


            <div class="am-g am-margin-top">
                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                    品牌描述
                </div>
                <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                    <textarea rows="4" name="description"></textarea>
                </div>
            </div>

            <div class="am-g am-margin-top">
                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                    是否显示
                </div>
                <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                    <label class="am-radio-inline">
                        <input type="radio" value="1" name="is_show" checked> 是
                    </label>
                    <label class="am-radio-inline">
                        <input type="radio" value="0" name="is_show"> 否
                    </label>
                </div>
            </div>

            <div class="am-g am-margin-top">
                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                    排序
                </div>
                <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                    <input type="text" name="sort_order" class="am-input-sm" value="99">
                </div>
            </div>

            <div class="am-margin">
                <button type="submit" class="am-btn am-btn-primary am-radius">提交保存</button>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="/js/jquery.html5-fileupload.js"></script>
    <script>
        //文件上传
        var opts = {
            url: "/admin/system/photo/upload",
            type: "POST",
            beforeSend: function () {
                $("#loading").attr("class", "am-icon-spinner am-icon-pulse");
            },
            success: function (result, status, xhr) {
                if (result.status == "0") {
                    alert(result.msg);
                    $("#loading").attr("class", "am-icon-cloud-upload");
                    return false;
                }
                console.log(result);
                $("input[name='image']").val(result.image_url);
                $("#img_show").attr('src', result.image_url);
                $("#loading").attr("class", "am-icon-cloud-upload");
            },
            error: function (result, status, errorThrown) {
                alert('文件上传失败');
            }
        }

        $('#image_upload').fileUpload(opts);
    </script>
@endsection
