@extends('layouts.app_s')

@section('content')
<div class="form-wrapper">
  <h1 style="padding:0 0;">新規登録</h1>
  <form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="form-item">
      <label for="name"></label>
      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="お名前" required autocomplete="name" autofocus>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-item">
      <label for="email"></label>
      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-Mail" required autocomplete="email">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-item">
      <label for="password"></label>
      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="パスワード" required autocomplete="new-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-item">
      <label for="password-confirm"></label>
      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="パスワード再入力" required autocomplete="new-password">
    </div>
    <div class="form-item">
      <label for="url"></label>
      <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" placeholder="ご使用されるurl" required>
      @error('url')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="button-panel">
      <input id="btnSubmit" type="submit" class="button" title="Start" value="Start"></input>
    </div>
  </form>
  <div class="form-footer" style="padding-top:0;padding-bottom:5px;margin-bottom:0;">
    <p><a href="{{ route('login') }}"><i class="far fa-bell"></i>ログインはこちら</a></p>
  </div>
</div>
<div style="text-align:center">            
    <a href="/" style="color:#FB9105"><img class="loimg" src="{{asset('images/home.svg')}}"></a>      
</div>

@endsection