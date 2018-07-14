@extends('layouts.app')

@section('title') Student @endsection

@section('headside')
    @include('student.includes.header')
    @include('student.includes.side-menu')
@endsection


@section('content')
<p><strong>Grades</strong></p>
<section class="section">
	<div class="row">
		<div class="col-md-12">
			@include('includes.all')

			@if(count($subjects) > 0)
				@foreach($subjects as $s)
					<p><a href="{{ route('student.view.subject.grades', ['id' => $s->id]) }}">View Grades for {{ $s->code }}</a></p>
				@endforeach
			@else
				<p>No subjects!</p>
			@endif
		</div>
	</div>
</section>
@endsection