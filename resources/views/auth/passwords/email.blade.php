@extends('layouts.login_app')
@section('content')
    <form method="POST" action="{{ route('password.email') }}">
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

            <button type="submit" class="btn btn-default btn-block">Send Password Reset Link</button>
        </div>
    </form>
@endsection
