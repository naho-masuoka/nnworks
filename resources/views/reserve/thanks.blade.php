
@extends('layouts.app_s')
@section('content')
<div class="container">
    <br>
    <h3>{{$request->name}} 様</h3>
    <br>
    <p>お申込み完了致しました。</p>
    <p>当日お会いできることを楽しみにしております。</p>    
    <img src="{{ asset('/images/thanks.svg') }}">
    <br>
    <div class="text-center">
    <br><br><br><br>
        <a href="/home/{{$user->url}}" class="btn-c m-2">TOPページへ</a>
    </div>
</div>
@endsection