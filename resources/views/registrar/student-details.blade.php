@extends('layouts.app')

@section('title') Registrar @endsection

@section('headside')
    @include('registrar.includes.header')
    @include('registrar.includes.side-menu')
@endsection


@section('content')
<section class="section">
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Student Number: {{ $student->student_number }} </p>
                    </div>
                </div>
                <div class="card-block">
                	@include('includes.all')
                    <p>
                        Enrolled in 
                        @if($student->info->course_id != null)
                            {{ $student->info->course->title }} - 
                            @if($student->info->year_level == 1)
                                First Year
                            @else
                                Second Year
                            @endif
                        @else
                            {{ $student->info->program->title }}
                        @endif
                    </p>
					<p>Name: <strong>{{ ucwords($student->firstname . ' ' . $student->lastname) }}</strong></p>
                    <p>Student Number: <strong>{{ $student->student_number }}</strong></p>
                    <p>Mobile Number: <strong>{{ $student->mobile_number }}</strong></p>
                    <p>Date of Birth: <strong>{{ date('F j, Y', strtotime($student->info->date_of_birth)) }}</strong></p>
                    <p>Place of Birth: <strong>{{ ucwords($student->info->place_of_birth) }}</strong></p>
                    <p>Address: <strong>{{ ucwords($student->info->address) }}</strong></p>
                    <p>Nationality: <strong>{{ ucwords($student->info->nationality) }}</strong></p>
                    <p>SY Admitted:</p>
                    <p>School Last Attended:</p>
                    <p>Date Graduated:</p>
                </div>
                <div class="card-footer"> <small>Student Details</small> </div>
            </div>
        </div>
    </div>
</section>
@endsection