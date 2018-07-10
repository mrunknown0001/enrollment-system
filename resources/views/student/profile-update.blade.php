@extends('layouts.app')

@section('title') Student @endsection

@section('headside')
    @include('student.includes.header')
    @include('student.includes.side-menu')
@endsection

@section('content')

<section class="section">
    <div class="row">

        <div class="col-xl-6">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Student Profile Update </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')
                    <form id="signup-form" action="{{ route('student.profile.update.post') }}" method="POST" role="form" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control underlined" name="firstname" id="firstname" value="{{ Auth::user()->firstname }}" placeholder="Enter firstname" required=""> </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control underlined" name="lastname" id="lastname" value="{{ Auth::user()->lastname }}" placeholder="Enter lastname" required=""> </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control underlined" value="{{ Auth::user()->student_number }}" disabled="">
                        </div>
                        <div class="form-group">
                            <input type="text" name="mobile_number" id="mobile_number" class="form-control underlined" value="{{ Auth::user()->mobile_number }}" placeholder="Enter Mobile Number" required="">
                        </div>
                        <div class="form-group">
                            <input type="text" name="date_of_birth" id="date_of_birth" class="form-control underlined" value="{{ date('m', strtotime(Auth::user()->info->date_of_birth)) }}/{{ date('d', strtotime(Auth::user()->info->date_of_birth)) }}/{{ date('Y', strtotime(Auth::user()->info->date_of_birth)) }}" placeholder="mm/dd/yyyy" required="">
                        </div>
                        <div class="form-group">
                            <input type="text" name="place_of_birth" id="place_of_birth" class="form-control underlined" value="{{ Auth::user()->info->place_of_birth }}" placeholder="Enter Place of Birth" required="">
                        </div>
                        <div class="form-group">
                            <input type="text" name="address" id="address" class="form-control underlined" value="{{ Auth::user()->info->address }}" placeholder="Enter Address" required="">
                        </div>
                        <div class="form-group">
                            <input type="text" name="nationality" id="nationality" class="form-control underlined" value="{{ Auth::user()->info->nationality }}" placeholder="Enter Nationality" required="">
                        </div>
                        <div class="form-group">
                            <input type="text" name="school_last_attended" id="school_last_attended" class="form-control underlined" value="{{ Auth::user()->info->school_last_attended }}" placeholder="School Last Attended">
                        </div>
                        <div class="form-group">
                            <input type="text" name="year_graduated" id="year_graduated" class="form-control underlined" value="{{ Auth::user()->info->date_graduated }}" placeholder="Year Graduated">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer"> <small>Student Profile Update</small> </div>
            </div>
        </div>

    </div>
</section>

@endsection