@extends('layouts.student-layout')

@section('content')
<div class="auth">
    <div class="auth-container">
        <div class="card">
            <header class="auth-header">
                <h1 class="auth-title">
                    <!-- <img src="{{ asset('uploads/imgs/logo.png') }}" height="40px" width="auto"> -->
                    &nbsp; Password Reset: Enter Code
                </h1>
            </header>
            <div class="auth-content">
                @include('includes.all')
                <form id="login-form" action="{{ route('student.password.reset.post') }}" method="POST" novalidate="" autocomplete="off">
                    {{ csrf_field() }}
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <div class="form-group">
                        <label for="student_number">Enter Password Reset Code</label>
                        <input type="text" class="form-control underlined" name="reset_code" id="reset_code" value="" placeholder="Enter Reset Code" required> </div>

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