@extends('layouts.app')

@section('title') Registrar @endsection

@section('headside')
    @include('registrar.includes.header')
    @include('registrar.includes.side-menu')
@endsection

@section('content')
<section class="section">
    <div class="row">
        <div class="col-md-12">
            <div class="container card">
                <header class="auth-header">
                    <h2 class="auth-title">
                        Student Registration
                    </h2>
                </header>
                <div class="auth-content">
                    @include('includes.all')
                    <form id="signup-form" action="{{ route('registrar.student.registration.post') }}" method="POST" novalidate="" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="firstname">Name</label>
                            <div class="row">
                                <div class="col-sm-4">
                                    <input type="text" class="form-control underlined" name="firstname" id="firstname" placeholder="Enter firstname" required=""> </div>
                                <div class="col-sm-4">
                                    <input type="text" name="middlename" id="middlename" class="form-control underlined" placeholder="Enter Middlename">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control underlined" name="lastname" id="lastname" placeholder="Enter lastname" required=""> </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Gender:</label>
                            <input type="radio" name="gender" id="male">
                            <label for="male">Male</label>
                            <input type="radio" name="gender" id="female">
                            <label for="female">Female</label>
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
                            <label>Parent/Guardian</label>
                            <input type="text" name="parent_guardian" id="parent_guardian" class="form-control underlined" placeholder="Enter Parent/Guardian" required>
                        </div>

                        <div class="form-group">
                            <label>Parent/Guardian Contact</label>
                            <input type="text" name="parent_guardian_contact" id="parent_guardian_contact" class="form-control underlined" placeholder="Enter Parent/Guardian Contact Number" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control underlined" name="address" id="address" required="" placeholder="Enter address"></textarea> </div>

                        <div class="form-group">
                            <label for="nationality">Nationality</label>
                            <input type="text" class="form-control underlined" name="nationality" id="nationality" placeholder="Enter nationality" required=""> </div>

                        <div class="form-group">
                            <label for="religion">Religion</label>
                            <input type="text" name="religion" id="religion" class="form-control underlined" placeholder="Enter Religion">
                        </div>

                        <div class="form-group">
                            <h3>Requirements</h3>
                        </div>
                        <div class="form-group">
                            <label for="birth_certificate"><input type="checkbox" name="birth_certificate" id="birth_certificate" required> Birth Certificate</label>
                        </div>
                        <div class="form-group">
                            <label for="form_137"><input type="checkbox" name="form_137" id="form_137" required> Form 137</label>
                        </div>
                        <div class="form-group">
                            <label for="gmc"><input type="checkbox" name="gmc" id="gmc" required> Good Moral Character</label>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-user-plus"></i> Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
@include('includes.terms-and-policy')
@include('includes.privacy-policy')
@endsection