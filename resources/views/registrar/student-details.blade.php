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
            <p><a href="{{ route('registrar.view.students') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a></p>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Student Number: {{ $student->student_number }} </p>
                    </div>
                </div>
                <div class="card-block">
                	@include('includes.all')
                    @if($student->info->course_id != null)
                    <p>
                        @if($student->info->enrolled == 1)
                        <a href="{{ route('registrar.view.student.grades', ['id' => $student->id, 'sn' => $student->student_number]) }}" class="btn btn-primary"><i class="fa fa-eye"></i> View Grades</a>
                        @endif

                        <a href="{{ route('registrar.view.student.tor', ['id' => $student->id, 'sn' => $student->student_number]) }}" class="btn btn-primary"><i class="fa fa-eye"></i> TOR</a>
                    </p>
                    <p>
                    @else
                    <p>
                        @if($student->info->enrolled == 1)
                        <a href="{{ route('registrar.view.student.remarks', ['id' => $student->id, 'sn' => $student->student_number]) }}" class="btn btn-primary"><i class="fa fa-eye"></i> View Remarks</a>
                        @endif
                    </p>
                    @endif
                    @if(count($student->enrollment_status) > 0)
                        Enrolled in 
                        @if($student->info->course_id != null)
                            {{ $student->info->course->title }} - 
                            @if($student->info->year_level == 1)
                                First Year 
                            @else
                                Second Year
                            @endif
                            - {{ !empty($enrollment_status) ? $enrollment_status->semester_id == 1 ? '1st Semester' : '2nd Semester' : '' }}
                        @else
                            {{ $student->info->program->title }}
                        @endif
                    @else
                        Not yet enrolled
                    @endif
                    </p>
					<p>Name: <strong>{{ ucwords($student->firstname . ' ' . $student->lastname) }}</strong></p>
                    <p>Student Number: <strong>{{ $student->student_number }}</strong></p>
                    <p>Mobile Number: <strong>{{ $student->mobile_number }}</strong></p>
                    <p>Date of Birth: <strong>{{ date('F j, Y', strtotime($student->info->date_of_birth)) }}</strong></p>
                    <p>Place of Birth: <strong>{{ ucwords($student->info->place_of_birth) }}</strong></p>
                    <p>Address: <strong>{{ ucwords($student->info->address) }}</strong></p>
                    <p>Nationality: <strong>{{ ucwords($student->info->nationality) }}</strong></p>
                    <p>SY Admitted: <strong>{{ $student->info->sy_admitted ? $student->info->sy_admitted->from . '-' . $student->info->sy_admitted->to : 'N/A' }}</strong></p>
                    <p>School Last Attended:</p>
                    <p>Date Graduated:</p>
                    <p>Parent/Guardian: {{ $student->info->parent_guardian }}</p>
                    <p>Parent/Guardian Contact Number: {{ $student->info->parent_guardian_contact }}</p>
                </div>
                <div class="card-footer"> <small>Student Details</small> </div>
            </div>
        </div>
    </div>
</section>
@endsection