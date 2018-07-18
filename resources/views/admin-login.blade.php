@extends('layouts.app-guess')

@section('content')
<div class="auth">
    <div class="auth-container">
        <div class="card">
            <header class="auth-header">
                <h1 class="auth-title">
                    <img src="{{ asset('uploads/imgs/logo.png') }}" height="40px" width="auto">
                    &nbsp; Admin Login
                </h1>
            </header>
            <div class="auth-content">
                @include('includes.all')
                <form id="login-form" action="{{ route('admin.login.post') }}" method="post" novalidate="" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control underlined" name="username" id="username" placeholder="Your username" required> </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control underlined" name="password" id="password" placeholder="Your password" required> </div>
                    <div class="form-group">
                        <label for="remember">
                            <input class="checkbox" id="remember" name="remember" type="checkbox">
                            <span>Remember me</span>
                        </label>
                        <!-- <a href="reset.html" class="forgot-btn pull-right">Forgot password?</a> -->
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">Login</button>
                    </div>
                    <div class="form-group">
                        <!-- <p class="text-muted text-center">Do not have an account?
                            <a href="signup.html">Sign Up!</a>
                        </p> -->
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center">
            <a href="{{ route('welcome') }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> Back to Welcome Page </a>
        </div>
    </div>
</div>
@endsection