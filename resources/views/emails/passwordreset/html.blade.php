
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
    <p>パスワードリセットを受け付けました。<br><br>
        このパスワードリセットリンクは<br>60分で期限切れとなります。<br>       
    </p>
    <div style="text-align:center">
        <a href="{{$reset_url}}"><h3 class="button">パスワードリセット</h3></a>
    </div>
    <style>
        .button {
            background: #db6d69;            
            border: none;
            cursor: pointer;
            height: 50px;
            font-family: 'Open Sans', sans-serif;
            font-size: 1.2em;
            letter-spacing: 0.05em;
            text-align: center;
            text-transform: uppercase;
            transition: background 0.3s ease-in-out;
            width: 100%;
            border-radius:10px;
            box-shadow: 0 5px 5px 0 rgba(0, 0, 0, .5);
        }
        .button a{
            color:white;
            text-decoration:none;
        }
    </style>
<body>
    </html>