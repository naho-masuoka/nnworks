@extends('layouts.app_s')
@section('content')
    <div class="container">
        <br>
        <p>
            講座の「キャンセル」を承りました。<br>
            ご連絡頂きありがとうございました。
        </p>
    
        
        <br><br>
        
        <img src="{{ asset('/images/thanks.svg') }}">
        <br><br><br><br>
        <hr>
        <div class="text-center">
            <a href="/home/{{$user->url}}" class="btn btn-primary m-2">TOPページへ</a>
        </div>
    </div>
@endsection