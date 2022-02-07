
@extends('layouts.app_s')
@section('content')
    <div class="container">
        <br>
        <p>Mail送信完了致しました。</p>
        
        <img src="{{ asset('/images/thanks.svg') }}">
        
        <br><br><br><br><br>
        <div class="text-center">
            <a href="/home/{{$user->url}}" class="btn-c m-2">TOPページへ</a>
        </div>
    </div>
@endsection