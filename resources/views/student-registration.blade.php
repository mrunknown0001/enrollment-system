@extends('layouts.student-layout')

@section('content')
<div class="auth-registration">
    <div class="auth-container-registration">
        <div class="card">
            <header class="auth-header">
                <h1 class="auth-title">
                    <!-- <img src="{{ asset('uploads/imgs/logo.png') }}" height="40px" width="auto"> -->
                    &nbsp; Student Registration
                </h1>
            </header>
            <div class="auth-content">
                @include('includes.all')
                <form id="signup-form" action="{{ route('student.registration.post') }}" method="POST" novalidate="" autocomplete="off">
                    {{ csrf_field() }}
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
                        <input type="text" class="form-control underlined" name="mobile_number" id="mobile_number" placeholder="Enter 11 digit mobile number" required=""> </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="password" class="form-control underlined" name="password" id="password" placeholder="Enter password" required=""> </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control underlined" name="password_confirmation" id="password_confirmation" placeholder="Re-type password" required=""> </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="text" class="form-control underlined" name="date_of_birth" id="date_of_birth" placeholder="mm/dd/yyyy" required=""> </div>

                    <div class="form-group">
                        <label for="place_of_birth">Place of Birth</label>
                        <input type="text" class="form-control underlined" name="place_of_birth" id="place_of_birth" placeholder="Enter place of birth" required=""> </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control underlined" name="address" id="address" required="" placeholder="Enter address"></textarea> </div>

                    <div class="form-group">
                        <label for="nationality">Nationality</label>
                        <input type="text" class="form-control underlined" name="nationality" id="nationality" placeholder="Enter nationality" required=""> </div>

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