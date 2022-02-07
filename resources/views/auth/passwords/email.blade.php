@extends('layouts.app_s')

@section('content')
<div class="container">
    <div class="form-wrapper">
    <h1>パスワード送信</h1>
        <form method="POST" action="{{ route('password.email') }}">
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
            <div class="button-panel">
                <input type="submit" class="button" value="送信"></input>
            </div>
        </form>
        <br><br>
    </div>
    <div style="text-align:center">            
      <a href="/" style="color:#FB9105"><img class="loimg" src="{{asset('images/home.svg')}}"></a>      
    </div>
</div>
@endsection
