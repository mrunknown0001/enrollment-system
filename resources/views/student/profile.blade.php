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
                        <p class="title"> Student Profile </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')
					<p>Name: <strong>{{ ucwords(Auth::user()->firstname . ' ' . Auth::user()->lastname) }}</strong></p>
                    <p>Student Number: <strong>{{ Auth::user()->student_number }}</strong></p>
                    <p>Mobile Number: <strong>{{ Auth::user()->mobile_number }}</strong></p>
                    <p>Date of Birth: <strong>{{ date('F j, Y', strtotime(Auth::user()->info->date_of_birth)) }}</strong></p>
                    <p>Place of Birth: <strong>{{ ucwords(Auth::user()->info->place_of_birth) }}</strong></p>
                    <p>Address: <strong>{{ ucwords(Auth::user()->info->address) }}</strong></p>
                    <p>Nationality: <strong>{{ ucwords(Auth::user()->info->nationality) }}</strong></p>
                    @if(count(Auth::user()->info->sy_admitted) > 0)
                    <p>AY Admitted: <strong>{{ Auth::user()->info->sy_admitted->from . '-' . Auth::user()->info->sy_admitted->to }}</strong></p>
                    @endif
                    <p>School Last Attended: <strong>{{ ucwords(Auth::user()->info->school_last_attended) }}</strong></p>
                    <p>Year Graduated: <strong>{{ Auth::user()->info->date_graduated }}</strong></p>
                    <p><a href="{{ route('student.profile.update') }}" class="btn btn-primary">Update Profile</a></p>
                </div>
                <div class="card-footer"> <small>Student Profile</small> </div>
            </div>
        </div>

    </div>
</section>

@endsection