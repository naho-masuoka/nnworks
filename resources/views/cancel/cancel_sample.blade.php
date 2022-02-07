@extends('layouts.app_s')
@section('content')
    <div class="container">
    <a href="#" class="btn btn-primary m-2" onclick="history.back(-1);return false;">戻る</a>
        <br>
        <p>〇〇〇〇様<br><br>
            講座の「キャンセル」を承ります。<br>
            下記ボタンを押してキャンセルを完了させてください。<br><br>
        </p>
        <hr>
        <p>
            日時：〇〇〇〇年〇月〇日 〇:〇～〇:〇<br>
            講座：講座名<br><br>
        </p>
        <hr>
    
        <br><br>
        <div class="text-center">
                <button class="btn btn-primary m-2">講座申込キャンセル</button> 
            <br><br><br><br>        
        </div>
        <img src="{{ asset('/images/thanks.svg') }}">
    </div>
@endsection