@extends('layouts.student-layout')

@section('content')
<div class="auth">
    <div class="auth-container">
        <div class="card">
            <header class="auth-header">
                <h1 class="auth-title">
                    <!-- <img src="{{ asset('uploads/imgs/logo.png') }}" height="40px" width="auto"> -->
                    &nbsp; Student Login
                </h1>
            </header>
            <div class="auth-content">
                @include('includes.all')
                <form id="login-form" action="{{ route('student.login.post') }}" method="POST" novalidate="" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="student_number">Student Number</label>
                        <input type="text" class="form-control underlined" name="student_number" id="student_number" value="{{ session('student_number') }}" placeholder="Your Student Number" required> </div>
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
                        <label for="terms_and_condition">
                            <input class="checkbox" id="terms_and_condition" name="terms_and_condition" type="checkbox" required>
                            <span>I Agree to the <a data-toggle="modal" data-target="#terms-and-policy-modal" class="btn btn-link">Terms and Condition</a></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">Login</button>
                    </div>
                    <div class="form-group">
                        {{-- <p class="text-muted">Register
                            <a href="{{ route('student.registration') }}">here!</a>
                        </p> --}}
                        <p class="text-muted">
                            Forgot password? click <a href="{{ route('student.forgot.password') }}">here</a>
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
@include('includes.terms-and-policy')