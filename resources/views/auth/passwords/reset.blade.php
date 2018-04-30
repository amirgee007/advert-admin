@extends('layouts.login_app')
@section('content')
    <form method="POST" action="{{ route('password.reset') }}">
        {{ csrf_field() }}
        <div class="top">
            <img src="/img/kode-icon.png" alt="icon" class="icon">
            <h1>{{ config('app.name', 'Laravel') }}</h1>
        </div>
        <div class="form-area">
            <div class="group">
                <input type="email" name="email" class="form-control" placeholder="Email">
                <i class="fa fa-user"></i>
            </div>

            <div class="group">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <i class="fa fa-key"></i>
            </div>

            <div class="group">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                <i class="fa fa-key"></i>
            </div>

            <button type="submit" class="btn btn-default btn-block">Reset Password</button>
        </div>
    </form>
@endsection
