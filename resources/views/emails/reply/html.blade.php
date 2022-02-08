
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
    <p> {!! nl2br(e($data['body'])) !!}<br>
    <p>
        講座開催場所:<br>
        {{ $data['place'] }}<br>
        {{ $data['shop_name'] }}<br>
    </p>
        またキャンセルは下記よりお願い致します。
        <br><br>
        ※当日のキャンセルは担当者に直接ご連絡下さい。
    </p>
    <div style="text-align:center">
        <a href="http://nnworks.herokuapp.com/cancel/?param={!! $param !!}" style="background-color:{{$user['bg']}};color:{{$user['font']}};font-size:15px;border-radius:10px;padding:10px 10px;text-decoration:none;">
        キャンセル
        </a>        
    </div>
   
    
    <p>{{$data['signature']}}</p>
<body>
    </html>