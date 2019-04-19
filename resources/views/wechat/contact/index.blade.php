@extends('wechat.layouts.application')
@section('css')
@endsection
@section('content')
    <div class="page-address-edit" data-log="反馈">
        <div class="edit-box">
            <ul class="ui-list">
                <li class="ui-list-item">
                    <div class="label">姓名：</div>
                    <div class="ui-input"><input placeholder="真实姓名" name="name" maxlength="15" type="text">
                    </div>
                </li>
                <li class="ui-list-item">
                    <div class="label">手机号码：</div>
                    <div class="ui-input"><input placeholder="手机号" name="mobile" maxlength="13" type="mobile"></div>
                </li>
                <li class="ui-list-item">
                    <div class="label">反馈信息：</div>
                    <div class="ui-input">
                        <input placeholder="反馈信息" name="contact" maxlength="120" type="text">
                    </div>
                </li>
            </ul>
            <div class="save-button">
                <a href="javascript:;" class="ui-button"><span>发送反馈</span></a>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(".save-button").click(function () {

            $.ajax({
                url: "/wechat/contact",
                type:"post",
                data: {
                    name: $("input[name='name']").val(),
                    mobile: $("input[name='mobile']").val(),
                    contact: $("input[name='contact']").val(),
                },
                //dataType: 'json',
                success: function (data) {
                    alert(data.msg);
                    if (data.status=='0000'){
                        location.href = "/wechat/customer";
                    }
                }
            });

        });
    </script>
@endsection
