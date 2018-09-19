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
            <p><a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a></p>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Student Remark </p>
                    </div>
                </div>
                <div class="card-block">
                	@include('includes.all')
					<p>{{ $program->code }} - {{ $program->description }}</p>
					<p>{{ ucwords($student->firstname . ' ' . $student->lastname) }} - {{ $student->student_number }}</p>
					<p>
                        @if(count($remark) > 0)
                            @if($remark->remarks == 1)
                            <strong>Student is Competent</strong>
                            @else
                            <strong>Student is Not Yet Competent</strong>
                            @endif
                            <p><a href="{{ route('registrar.update.student.program.remarks', ['id' => $student->id, 'pid' => $program->id]) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Update Remark</a></p>
                        @else
                        <strong>No Remarks</strong>
                        @endif
					</p>
                    
                </div>
                <div class="card-footer"> <small> Student Remark </small> </div>
            </div>
        </div>
    </div>
</section>
@endsection