
<footer class="footer navbar fixed-bottom d-flex justify-content-around align-items-center mytitle u_color">
    @auth 
        <a href="/home/{{ Auth::user()->url }}"><i class="fas fa-home fa-fw fa-lg"></i></a>
        <a href="/time_table"><i class="far fa-calendar-alt fa-fw fa-lg"></i></a>
        <a href="/title"><i class="far fa-file-alt fa-fw fa-lg"></i></a>
        <a href="{{ route('users') }}"><i class="fas fa-user-cog fa-fw fa-lg"></i></a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fas fa-times fa-fw fa-lg"></i></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="url" value="{{ Auth::user()->url }}">
            </form>
    @else
    
    @if($user->hp <> null)
        <a href="{{$user->hp}}"><i class="fas fa-globe fa-fw"></i>hp</a> 
    @endif
    @if($user->blog <> null)
        <a href="{{$user->blog}}"><i class="far fa-comment-dots fa-fw"></i>blog</a>
    @endif
    <div><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt fa-fw"></i>ログイン</a>        
    @endauth
    <style>
        .u_color{
            background-color:{{$user->bg}}; 
            color:{{$user->font}};
        }
        .u_color a{
            color:{{$user->font}};
        }
        .mytitle{
            padding: 0.2rem 0;/*上下の余白*/
            width:100%;
            text-align:center;
            
            }
        .mytitle li a{
            color:{{$user->font}};
        }
    </style>
</footer>

