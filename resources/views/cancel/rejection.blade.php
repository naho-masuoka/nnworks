@extends('layouts.app_s')
@section('content')
    <div class="container">
        <br>
        <p>
            {{ $data->name }}　様<br><br>
            申し訳ありません。<br>
            当日のキャンセルは <a href="{{ $link }}">{{Auth::user()->name}}</a> へ直接ご連絡下さい。
            <a href="mailto:address?subject=&amp;body="></a>    
        </p>
        
        <br><br>
        
        <img src="{{ asset('/images/thanks.svg') }}">
        <br><br><br><br>
        <div class="text-center">
        <a href="/home/{{$user->url}}"class="btn btn-primary m-2">TOPページへ</a><br><br><br><br>  
        </div>
    </div>
@endsection