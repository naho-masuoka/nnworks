
@extends('layouts.app_s')
@section('content')
    <div class="container">
        <br>
        <p>Mail送信完了致しました。</p>
        <div class="text-center">
            <a href="/" class="btn btn-primary m-2">TOPページへ</a>
        </div>
        <img src="{{ asset('/images/thanks.svg') }}">
    </div>
@endsection