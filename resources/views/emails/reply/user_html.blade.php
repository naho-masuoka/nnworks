<!doctype html>
    <html lang="ja">
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
    <p> {!! nl2br(e($data['body'])) !!}<br>
        またキャンセル等は下記よりお願い致します。
        <h5>キャンセルはこちら</h5><br>
        ※当日のキャンセルは担当者に直接ご連絡下さい。
    </p>

    <p>
        講座開催場所:<br>
        {{ $data['place'] }}<br>
        {{ $data['shop_name'] }}<br>
    </p>
    <a href="{{ $data['mailmap'] }}">地図はこちら</a><br><br><br>
    
    <p>{{$data['signature']}}</p>
    <body>
</html>