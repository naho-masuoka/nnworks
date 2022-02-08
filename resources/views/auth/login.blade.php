@extends('layouts.app_s')

@section('content')
<div class="container">
  <div class="form-wrapper">
    <h3 class="text-center pt-2">Welcome to the Works</h3>
    <form method="POST" action="{{ route('login') }}" autocomplete="off">
          @csrf
      <div class="form-item">
        <label for="email"></label>
        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address" autofocus>
        @error('email')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
      </div>
      <div class="form-item">
        <label for="password"></label>
        <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="パスワード" required autocomplete="current-password">
          @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>
      <div class="button-panel">
        <input type="submit" class="button" title="Go" value="Start" ontouchstart></input>
      </div>
      <br><br>
    </form>
  </div>  


  <div class="form-footer">
    <div class="row">
      <div style="width:70%; margin:0 0;">
        <p><a href="{{ route('register') }}"><i class="far fa-bell"></i>新規登録</a></p>
        @if (Route::has('password.request'))
          <p><a href="{{ route('password.request') }}"><i class="fas fa-bell"></i>{{ __('パスワードを忘れた方') }}</a></p>
        @endif
      </div>
      <div style="width:30%; margin:0 0; text-align:center">            
        <a href="/" style="color:#FB9105"><img class="loimg" src="{{asset('images/home.svg')}}"></a>      
      </div>
    </div>



@endsection
