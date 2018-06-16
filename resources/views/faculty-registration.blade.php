@extends('layouts.app-guess')

@section('content')
<div class="auth">
    <div class="auth-container">
        <div class="card">
            <header class="auth-header">
                <h1 class="auth-title">
                    <div class="logo"><!-- 
                        <span class="l l1"></span>
                        <span class="l l2"></span>
                        <span class="l l3"></span>
                        <span class="l l4"></span>
                        <span class="l l5"></span> -->
                    </div> Faculty Registration </h1>
            </header>
            <div class="auth-content">
                <form id="signup-form" action="#" method="POST" novalidate="">
                	<div class="form-group">
                		<label for="id_number">ID Number</label>
                		<input type="text" class="form-control underlined" name="id_number" id="id_number" placeholder="Enter ID Number" required="">
                	</div>
                    <div class="form-group">
                        <label for="firstname">Name</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control underlined" name="firstname" id="firstname" placeholder="Enter firstname" required=""> </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control underlined" name="lastname" id="lastname" placeholder="Enter lastname" required=""> </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile_number">Mobile Number</label>
                        <input type="text" class="form-control underlined" name="mobile_number" id="mobile_number" placeholder="Enter mobile number" required=""> </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="password" class="form-control underlined" name="password" id="password" placeholder="Enter password" required=""> </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control underlined" name="retype_password" id="retype_password" placeholder="Re-type password" required=""> </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="agree">
                            <input class="checkbox" name="agree" id="agree" type="checkbox" checked="" required="">
                            <span>Agree the
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#terms-and-policy-modal">Terms and Policy</a>
                            </span>
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">Sign Up</button>
                    </div>
                    <div class="form-group">
                        <p class="text-muted text-center">Already have an account?
                            <a href="{{ route('student.login') }}">Login!</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center">
            <a href="{{ route('welcome') }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> Back Welcome Page </a>
        </div>
    </div>
</div>

@include('includes.terms-and-policy')

@endsection