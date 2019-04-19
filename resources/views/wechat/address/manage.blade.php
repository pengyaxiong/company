@extends('wechat.layouts.application')

@section('content')
    <div class="page-address-list" data-log="地址列表">

        <div class="address-manage">
            <div class="ui-card">

                @foreach($addresses as $address)
                    <ul class="ui-card-item ui-list">
                        <li class="ui-list-item identity">
                            <a href="{{route('wechat.address.destroy', $address->id)}}" data-method="delete"
                               data-token="{{csrf_token()}}" class="delete">删除</a>
                            <span class="consignee">{{$address->name}}</span>
                            <span>{{$address->tel}}</span>
                        </li>
                        <li class="ui-list-item edit" onclick="location.href='{{route('wechat.address.edit', $address->id)}}'">
                            <p>{{$address->province}} {{$address->city}} {{$address->area}}</p>
                            <p>{{$address->detail}}</p>
                        </li>
                    </ul>
                @endforeach

            </div>
        </div>


        <div class="add"><a href="{{route('wechat.address.create')}}" class="ui-button ui-button-active"><span>新建地址</span></a></div>
        <div class="popup-risk-check"></div>
    </div>
@endsection
