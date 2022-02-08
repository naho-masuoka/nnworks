
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
    <form action="{{ route('reply_send') }}" method="post" name="Form" onsubmit="go_submit()">                             
        {{ csrf_field() }}
        <div class="form-group">
            <input type="hidden" name="id" class="form-control" value="{{ $request['id'] }}">
            <input type="hidden" name="name" value="{{ $request['name'] }}" class="form-control">
            <label>email</label>
            <input type="email" name="email" value="{{ $request['email'] }}" class="form-control u-input">
        </div>
        <div class="form-group">
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
        <a href="/cancel_sample" class="p-2 btn-c u_color"></i>&nbsp;キャンセルはこちら&nbsp;<i class="fas fa-angle-right"></i></a>
            <a href="/cancel_rejection_sample" class="p-2 btn-c u_color">&nbsp;当日キャンセルはこちら&nbsp;<i class="fas fa-angle-right"></i></a>
        </div>
        
        <hr>
        <div class="form-group">
            <label for="exampleFormControlSelect1">署名</label>
            <input type="text" name="signature" class="form-control u-input" value="{{ Auth::user()->signature }}">
        </div>
        <div class="form-group">
            <button type="submit" class="form-control btn-c u_color" onClick="go_submit()">送信</button>
        </div>    
    </form>
    <br><br><br>
</div>
<style>
        .u_color{
            background-color:{{$user->bg}}; 
            color:{{$user->font}};
        }
        .u_color a{ 
            color:{{$user->font}};
        }
        .mytitle{
            padding: 0.2rem 0;/*上下の余白*/
            width:100%;
            text-align:center;
            }
        .mytitle li a{
            color:{{$user->font}};
        }
</style>
<script>
    function go_submit(){
        document.Form.submit();
    }
</script>

@endsection