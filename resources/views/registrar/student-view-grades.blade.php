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
			<p>Course: {{ $course->title }}</p>
			<p>{{ $sem->name }} | {{ $ay->from . '-' . $ay->to }}</p>
			@if(count($grades) > 0)
			<table class="table">
				<thead>
					<tr>
						<th>Subject Code</th>
						<th>Prelim</th>
						<th>Midterm</th>
						<th>Semi-Final</th>
						<th>Final</th>
					</tr>
				</thead>
				<tbody>
					@foreach($subjects as $sub)
					<tr>
						<td>{{ $sub->code }}</td>
						@foreach($grades as $g)
							@if($sub->id == $g->subject_id && $g->term_id == 1)
							<td>{{ $g->grade }}</td>
							@endif
							@if($sub->id == $g->subject_id && $g->term_id == 2)
							<td>{{ $g->grade }}</td>
							@endif
							@if($sub->id == $g->subject_id && $g->term_id == 3)
							<td>{{ $g->grade }}</td>
							@endif
							@if($sub->id == $g->subject_id && $g->term_id == 4)
							<td>{{ $g->grade }}</td>
							@endif
						@endforeach
					</tr>
					@endforeach
				</tbody>
			</table>
			@else
			<p>No Grades Available!</p>
			@endif
		</div>
	</div>
</section>
@endsection