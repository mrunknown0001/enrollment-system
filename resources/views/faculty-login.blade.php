@extends('layouts.app-guess')

@section('content')
<div class="auth">
    <div class="auth-container">
        <div class="card">
            <header class="auth-header">
                <h1 class="auth-title">
                    <div class="logo">
                        <!-- <span class="l l1"></span>
                        <span class="l l2"></span>
                        <span class="l l3"></span>
                        <span class="l l4"></span>
                        <span class="l l5"></span> -->
                    </div> Faculty Login </h1>
            </header>
            <div class="auth-content">
                <form id="login-form" action="{{ route('faculty.login.post') }}" method="POST" novalidate="" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="id_number">ID Number</label>
                        <input type="text" class="form-control underlined" name="id_number" id="id_number" placeholder="Your ID Number" required> </div>
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
                        <p class="text-muted text-center">Register
                            <a href="{{ route('faculty.registration') }}">here!</a>
                        </p>
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