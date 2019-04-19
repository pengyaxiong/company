@extends('wechat.layouts.application')
@section('css')
    <link rel="stylesheet" type="text/css" href="/vendor/citySelect/css/LArea.css">
    <link rel="stylesheet" type="text/css" href="/vendor/citySelect/css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="/vendor/citySelect/css/style.css"/>
@endsection
@section('content')
    <div class="page-address-edit" data-log="地址">
        <div class="edit-box">
            <ul class="ui-list">
                <li class="ui-list-item">
                    <div class="label">收货人：</div>
                    <div class="ui-input"><input placeholder="真实姓名" name="name" maxlength="15" type="text">
                    </div>
                </li>
                <li class="ui-list-item">
                    <div class="label">手机号码：</div>
                    <div class="ui-input"><input placeholder="手机号" name="tel" maxlength="13" type="tel"></div>
                </li>
                <li class="ui-list-item">
                    <div class="label">所在地区：</div>
                    <div class="ui-input">
                        <input id="demo" type="text" readonly="" name="pca" placeholder="城市选择特效" value="湖北省,武汉市,洪山区"/>
                    </div>
                </li>
                <li class="ui-list-item">
                    <div class="label">街道地址：</div>
                    <div class="ui-input"><input placeholder="详细地址" name="detail" maxlength="120" type="text">
                    </div>
                </li>
            </ul>
            <div class="save-button">
                <a href="javascript:;" class="ui-button"><span>保存地址</span></a>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="/vendor/citySelect/js/common.js"></script>
    <script type="text/javascript" src="/vendor/citySelect/js/city.data.min.js"></script>
    <script type="text/javascript" src="/vendor/citySelect/js/LArea.js"></script>
    <script>
        $(window).load(function () {
            var area = new LArea();
            area.init({
                'trigger': '#demo', //触发选择控件的文本框，同时选择完毕后name属性输出到该位置
                'valueTo': '#value', //选择完毕后id属性输出到该位置
                'keys': {
                    id: 'value',
                    name: 'text'
                }, //绑定数据源相关字段 id对应valueTo的value属性输出 name对应trigger的value属性输出
                'type': 1, //数据源类型
                'data': LAreaData //数据源
            });
            area.value = [16, 0, 6];//控制初始位置，注意：该方法并不会影响到input的value
        });
        $(".save-button").click(function () {

            $.ajax({
                url: "/wechat/address",
                type:"post",
                data: {
                    name: $("input[name='name']").val(),
                    tel: $("input[name='tel']").val(),
                    pca: $("input[name='pca']").val(),
                    detail: $("input[name='detail']").val(),
                },

                //dataType: 'json',
                success: function () {
                    location.href = "/wechat/address/manage";
                }
            });

        });
    </script>
@endsection
