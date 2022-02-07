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
        <p> 予約を受付ました。</p><br>
        <p>
        ご予約者：{{$data['name']}}様<br>
        ご連絡先：{{$data['email']}}<br>
        ご予約日：{{date('Y年n月j日',strtotime($data['day']))}}<br>
        ご予約時間：{{date('H:i',strtotime($data['start']))}}～{{date('H:i',strtotime($data['end']))}}<br>
        ご参加人数：{{$data['member']}}<br><br>
        {{$data['name']}}様からのメッセージ<br>
        {!! nl2br(e($data['memo'])) !!}
        </p>
    <body>
</html>