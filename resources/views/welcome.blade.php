<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>   
    <div id="app">        
        <div class="container d-flex justify-content-center mytop">
        <div class="card">
            <img src="{{asset('images/top.svg')}}"> 
            <div class="card-body">
                <h3 class="card-title">Work Schduler</h3>
                <p class="card-text">予約管理<br>
                    自動メール送信<br>
                    が作成できるスケジューラーです！</p>
                <div class="d-flex button01" >
                    <a href="{{ route('register') }}" ontouchstart>さぁ 始めよう !</a>
                    <a href="{{ route('login') }}" ontouchstart>ログインはこちら</a>
                </div>
            </div>
        </div>       
    </div> 

    <style>
        body{
            width:100%;
        }
        .card{
            width:100%;
            border:none;
        }
        .mytop{
            position: relative;
            top:100px;
        }
        .card-body{
            background-color:#8DCACE;
            border-radius:10px;
            
        }
        .card-title{
            font-weight:bold;
            margin:5vh 5vh;
        }
        .card-text{
            margin-left: 5vh;
        }
        img{
            max-height:30vh;
        }
       
        .button01 a {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 0 auto;
            padding: 1em 0.5em;
            width: 200px;
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            transition: 0.3s;
            border-radius: 240px 15px 100px 15px / 15px 200px 15px 185px;
            }

            .button01 a::after {
            content: '';
            width: 15px;
            height: 15px;
            border-top: 5px solid #fff;
            border-right: 5px solid #fff;
            transform: rotate(45deg);
            }

            .button01 a:active {
            text-decoration: none;
            background-color: #FF7878;
            }
            
            @media (min-width: 1200px) {
                .mytop{
                    position: relative;
                    top:50px;
                }
                .card{
                    width:50%;
                    border:none;
                } 
                .card-text{
                        margin:5vh 10vh;
                    }
            }
    </style>
</body>
</html>
