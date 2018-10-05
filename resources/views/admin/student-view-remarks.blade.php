@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><a href="{{ route('admin.students') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Students</a></p>
<p><strong>Student View Remarks</strong></p>
@include('includes.all')
<section class="section">
	<div class="row">
		<div class="col-md-12">
			<p>Name: {{ ucwords($student->firstname . ' ' . $student->lastname) }}</p>
			<p>Student Number: {{ $student->student_number }}</p>
			<p>Program: {{ $program->title }}</p>
			<p>Academic Year: {{ $ay->from . '-' . $ay->to }}</p>
			<p>
				@if(count($remarks) > 0)
					@if($remarks->remarks == 1)
					<strong>Student is Competent</strong>
					@else
					<strong>Student is Not Yet Competent</strong>
					@endif
				@else
				<p class="text-center">Remark Not Available</p>
				@endif
			</p>
		</div>
	</div>
</section>
@endsection