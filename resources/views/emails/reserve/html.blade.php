<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

</head>
<body>
    <h1> {{$data['name']}}様</h1>
    <p> 
        ご予約日：{{date('Y年n月j日',strtotime($data['day']))}}<br>
        ご予約時間：{{date('H:i',strtotime($data['start']))}}～{{date('H:i',strtotime($data['end']))}}<br>
        ご参加人数：{{$data['member']}}<br><br>
        メッセージ<br>：{!! nl2br(e($data['memo'])) !!}
        <br><br>
        講座開催の場所等は後日ご連絡致します。<br>
        キャンセルの場合は下記よりお願い致します。<br>        

        <a href="http://hhhworks.herokuapp.com/cancel/?param={!! $param !!}"><h5>→→→　キャンセル　←←←</h5></a><br>
        ※当日のキャンセルの場合は直接ご連絡下さい。
    </p>

    <br><br>
    <p>{{$data['signature']}}</p>
<body>
    </html>