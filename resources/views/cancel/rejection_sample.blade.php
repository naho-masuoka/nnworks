@extends('layouts.app_s')
@section('content')
    <div class="container">
        <br>
        <a href="#" class="btn btn-primary m-2" onclick="history.back(-1);return false;">戻る</a>
        <p>
            〇〇〇〇様<br><br>
            申し訳ありません。<br>
            当日のキャンセルは <a href="">{{Auth::user()->name}}</a> へ直接ご連絡下さい。
            <a href="mailto:address?subject=&amp;body="></a>    
        </p>
        
        <br><br>
        
        <img src="{{ asset('/images/thanks.svg') }}">
        <br><br><br><br>
        <div class="text-center">
            <a href="/" class="btn btn-primary m-2">TOPページへ</a><br><br><br><br>  
        </div>
    </div>
@endsection