
<?php
$week=['日','月','火','水','木','金','土',];
$w = '('.$week[date('w',strtotime($request['day']))].') ';
if (file_exists(asset('files/'.Auth::user()->pc))) {
    $pc_file=asset('files/'.Auth::user()->pc);
}else{
    $pc_file=asset('files/default/pc-dummy.png');
}
if (file_exists(asset('files/'.Auth::user()->sp))) {
    $sp_file=asset('files/'.Auth::user()->sp);
}else{
    $sp_file=asset('files/default/sp-dummy.png');
}
?>

@extends('layouts.app')
@section('content')
<img class="pc" src="{{ $pc_file }}" style="width:100%;">
<img class="sp" src="{{ $sp_file }}" style="width:100%;">

<div class="d-flex justify-content-center align-items-center">
    <h3 class="mytitle">Mail作成</h3>
</div>
<div class="container">
    <form action="{{ route('reply_send') }}" method="post" name="Form" onsubmit="return false">                             
        {{ csrf_field() }}
        <div class="form-group">
            <input type="hidden" name="id" class="form-control" value="{{ $request['id'] }}">
            <input type="hidden" name="name" value="{{ $request['name'] }}" class="form-control">
            <label>email</label>
            <input type="email" name="email" value="{{ $request['email'] }}" class="form-control u-input">
        </div>
        <div class="form-group">
            <label>開催場所</label><button class="btn btn-cc ml-2" onclick="getaddress()">地図表示</button>
            <input type="text" name="place" id="place" class="form-control u-input" placeholder="住所" value="{{ $request['place'] }}" >
            <input type="hidden" name="mailmap" id="mailmap" class="form-control" value="{{ $request['mailmap'] }}" >
        </div>
        <div class="form-group">
            <input type="text" name="shop_name" id="shop_name" value="{{ $request['shop_name'] }}" class="form-control u-input" placeholder="講座を開催する場所" >               
        </div>
        <div id="maparea">
            @if($request['map'] == null)
            <iframe name="map" id='map' width='98%' height='0px' frameborder='0'
                    src='https://www.google.com/maps/embed/v1/place?key=AIzaSyBh70WNHgSZDtvTD_p2CAmrchrHXmB0M_I&q='>
            @else
                <iframe id='map' width='98%' height='200px' frameborder='0' src="{{ $request['map'] }}">
            @endif
            </iframe>
        </div>
        <div id="messagearea">
        <textarea style="display:none" name="map" class="form-control">
                {{ $request['map'] }}
        </textarea>  
        </div>
        <div class="form-group">
            <label>件名</label>
            <input type="text" name="subject" class="form-control u-input" value="{{ $title }}の件" >
        </div>
        
    <div class="form-group">
            <textarea name="body" class="form-control u-input" rows="15">
{{ $request['name']}} 様

お申込みありがとうございます。

下記にてご予約承りました。

講座：{{ $title }}
日付:{{ date('Y年n月j日',strtotime($request['day'])) }}{{ $w }}
時間：{{ date('H時i分',strtotime($request['start'])) }}～{{ date('H時i分',strtotime($request['end'])) }}

当日お会いできることを楽しみにしております。

</textarea>        
        </div>
        <hr>
        <div class="d-flex justify-content-around align-items-center">
        <a href="/cancel_sample" class="p-2 btn-c"></i>&nbsp;キャンセルはこちら&nbsp;<i class="fas fa-angle-right"></i></a>
            <a href="/cancel_rejection_sample" class="p-2 btn-c">&nbsp;当日キャンセルはこちら&nbsp;<i class="fas fa-angle-right"></i></a>
        </div>
        
        <hr>
        <div class="form-group">
            <label for="exampleFormControlSelect1">署名</label>
            <input type="text" name="signature" class="form-control u-input" value="{{ Auth::user()->signature }}">
        </div>
        <div class="form-group">
            <button type="submit" class="form-control btn-c" onClick="go_submit()">送信</button>
        </div>    
    </form>
    <br><br><br>
</div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBh70WNHgSZDtvTD_p2CAmrchrHXmB0M_I" charset="utf-8"></script>
    <script>
        function getaddress() {
            let address = document.getElementById("place").value;
            let element = document.Form;
            let map = document.getElementById("map");
            let mailmap = document.getElementById("mailmap");
            let geocoder = new google.maps.Geocoder();
    
    
            geocoder.geocode(
            { address: address },
            function( results, status ){
                    if( status == google.maps.GeocoderStatus.OK ){
                        lat = results[ 0 ].geometry.location.lat();
                        lng = results[ 0 ].geometry.location.lng();
                        element.mailmap.value = 'https://maps.google.co.jp/maps?q=' + lat + ',' + lng +'&t=p&z=21';
                    }else{
                        alert( 'Faild：' + status );
                    }
            });
            let src = map.getAttribute('src');
            let shop_address="https://www.google.com/maps/embed/v1/place?key=AIzaSyBh70WNHgSZDtvTD_p2CAmrchrHXmB0M_I&q="+ address
            map.setAttribute('src', shop_address);
            map.style.height = '200px';           
            element.map.value = shop_address;
        }
        function go_submit(){
            document.modalForm.submit();
        }
    }
    </script>

@endsection