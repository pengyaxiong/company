@extends('wechat.layouts.application')

@section('content')
    <div class="page-address-edit" data-log="地址">

        <div class="edit-box">
            <ul class="ui-list">
                <li class="ui-list-item">
                    <div class="label">收货人：</div>
                    <div class="ui-input">
                        <input placeholder="真实姓名" name="name" maxlength="15" type="text" value="{{$address->name}}">
                    </div>
                </li>
                <li class="ui-list-item">
                    <div class="label">手机号码：</div>
                    <div class="ui-input">
                        <input placeholder="手机号" name="tel" maxlength="13" type="tel" value="{{$address->tel}}">
                    </div>
                </li>
                <li class="ui-list-item">
                    <div class="label">所在地区：</div>
                    <div class="ui-input">
                        <input placeholder="省 市 区" name="pca" id="pca" maxlength="20" type="text"
                               readonly="readonly" value="{{$address->province}} {{$address->city}} {{$address->area}}">
                    </div>
                </li>
                <li class="ui-list-item">
                    <div class="label">街道地址：</div>
                    <div class="ui-input">
                        <input placeholder="详细地址" name="detail" maxlength="120" type="text"
                               value="{{$address->detail}}">
                    </div>
                </li>
            </ul>
            <div class="save-button">
                <a href="javascript:;" class="ui-button"><span>保存地址</span></a>
            </div>
        </div>


        <div class="ui-mask" style="display:none;"></div>
        <div class="ui-pop" style="display:none;">
            <div class="ui-pop-content">
                <div class="region-list" id="city">

                </div>
            </div>
            <div class="ui-pop-title">选择所在地区</div>
            <div class="ui-pop-close"><a><span class="icon-10chahaokuang"></span></a></div>
        </div>
        <div class="popup-risk-check"></div>
    </div>
@endsection


@section('js')
    <script src="/vendor/wechat/js/citySelect.js"></script>
    <script>
        $(function () {
            $('.save-button').click(function () {
                var status = true;

                $("input").each(function () {
                    var val = $(this).val();
                    if (val == "") {
                        status = false;
                    }
                });

                if (status == false) {
                    alert('您的填写的地址不完整!');
                    return false;
                }

                var data = $("input").serialize();

                $.ajax({
                    type: "PUT",
                    url: "/wechat/address/{{$address->id}}",
                    data: data,
                    success: function (data) {
                        location.href = "/wechat/address/manage";
                    }
                })
            })
        })
    </script>
@endsection

