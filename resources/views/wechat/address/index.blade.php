@extends('wechat.layouts.application')

@section('content')
    <div class="page-address-list" data-log="地址列表">

        <div class="address-choose">
            <ul class="ui-list">

                @foreach($addresses as $address)
                    <li class="ui-list-item" data-id="{{$address->id}}">
                        <p class="ui_fz30">
                            <span class="consignee">{{$address->name}}</span><span>{{$address->tel}}</span>
                        </p>
                        <p>{{$address->province}} {{$address->city}} {{$address->area}}</p>
                        <p>{{$address->detail}}</p>
                    </li>
                @endforeach

            </ul>
        </div>

        <div class="add"><a href="{{Route('wechat.address.create')}}" class="ui-button ui-button-active"><span>新建地址</span></a>
        </div>
        <div class="popup-risk-check"></div>
    </div>
@endsection

@section('js')
    <script>
        $(function(){
            $("li").click(function(){
                var address_id = $(this).attr('data-id');
                $.ajax({
                    type:'PATCH',
                    url:"",
                    data:{address_id:address_id},
                    success:function(data){
                        location.href = "/wechat/order/checkout";
                    }
                })
            })
        })
    </script>
@endsection