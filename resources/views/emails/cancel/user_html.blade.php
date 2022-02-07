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
        <p> {{$data['name']}}様の{{ $title }}講座がキャンセルとなりました。</p>
        
        キャンセルした予約日：<br>{{date('Y年n月j日',strtotime($data['day']))}}<br>
        キャンセルした予約時間：<br>{{date('H:i',strtotime($data['start']))}}～{{date('H:i',strtotime($data['end']))}}<br>
    <br><br>
    <body>
</html>