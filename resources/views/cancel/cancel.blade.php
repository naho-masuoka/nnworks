@extends('layouts.app_s')
@section('content')
    <div class="container">
        <br>
        <p>{{ $data->name }}様<br><br>
            講座の「キャンセル」を承ります。<br>
            下記ボタンを押してキャンセルを完了させてください。<br><br>
        </p>
        <hr>
        <p>
            日時：{{ date('Y年n月j日 ',strtotime($data->day)) }}{{ date('H:i',strtotime($data->start)) }}～{{ date('H:i',strtotime($data->end ))}}<br>
            講座：{{$title}}<br><br>
        </p>
        <hr>
    
        <br><br>
        <div class="text-center">
            <form action="{{ route('cancel_complete') }}" method="post">                             
                {{ csrf_field() }}
                <input type="hidden" name="id" value = "{{ $data->id }}" >
                <input type="hidden" name="email" value = "{{ $data->email }}" >
                <button type="submit" class="btn btn-primary m-2">講座申込キャンセル</button>
            </form>    
            <br><br><br><br>        
        </div>
        <img src="{{ asset('/images/thanks.svg') }}">
    </div>
@endsection