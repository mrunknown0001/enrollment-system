@extends('layouts.app')

@section('title') Registrar @endsection

@section('headside')
    @include('registrar.includes.header')
    @include('registrar.includes.side-menu')
@endsection


@section('content')
<p><a href="{{ route('registrar.view.students') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Students</a></p>
<p><strong>Student View Grades</strong></p>
@include('includes.all')
<section class="section">
	<div class="row">
		<div class="col-md-12">
			<p>Name: {{ ucwords($student->firstname . ' ' . $student->lastname) }}</p>
			<p>Student Number: {{ $student->student_number }}</p>

			<p><em>Grades will displayed here</em></p>
		</div>
	</div>
</section>
@endsection