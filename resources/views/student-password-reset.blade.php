@extends('layouts.student-layout')

@section('content')
<div class="auth">
    <div class="auth-container">
        <div class="card">
            <header class="auth-header">
                <h1 class="auth-title">
                    <!-- <img src="{{ asset('uploads/imgs/logo.png') }}" height="40px" width="auto"> -->
                    &nbsp; Password Reset
                </h1>
            </header>
            <div class="auth-content">
                @include('includes.all')
                <form id="login-form" action="{{ route('student.forgot.password.post') }}" method="POST" novalidate="" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="student_number">Student Number</label>
                        <input type="text" class="form-control underlined" name="student_number" id="student_number" value="{{ session('student_number') }}" placeholder="Your Student Number" required> </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">Reset Password</button>
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