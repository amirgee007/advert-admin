@extends('layouts.login_app')
@section('content')
    <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="top">
            <img src="{{asset("/public/img/kode-icon.png")}}" alt="icon" class="icon">
            <h1>{{ config('app.name', 'Laravel') }}</h1>
        </div>
        <div class="form-area">
            <div class="group">
                <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' has-error' : '' }}" placeholder="Email">
                <i class="fa fa-user"></i>
            </div>

            @if ($errors->has('email'))
                <span class="invalid-feedback" style="color: red">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
            @endif
            <div class="group">
                <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' has-error' : '' }}" placeholder="Password">
                <i class="fa fa-key"></i>
            </div>

            @if ($errors->has('password'))
                <span class="invalid-feedback" style="color: red">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <div class="checkbox checkbox-primary">
                <input id="checkbox101" name="remember"  type="checkbox" checked>
                <label for="checkbox101"> Remember Me</label>
            </div>
            <button type="submit" class="btn btn-default btn-block">LOGIN</button>
        </div>
    </form>
    <div class="footer-links row">
        <div class="col-xs-12 text-center"><a href="{{ route('password.request') }}"><i class="fa fa-lock"></i> Forgot password</a></div>
    </div>
@endsection