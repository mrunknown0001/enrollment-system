@extends('layouts.app')

@section('title') Student @endsection

@section('headside')
    @include('student.includes.header')
    @include('student.includes.side-menu')
@endsection


@section('content')
<p><strong>Student Dashboard</strong></p>
<section class="section">
	<div class="row">
		<div class="col-md-12">
			@include('includes.all')

			@if(Auth::user()->info->enrolling_for == null) 
				@include('student.includes.set-enrollment')
			@else
				@if(Auth::user()->info->enrolling_for == 1 && Auth::user()->info->year_level == null)
				@include('student.includes.select-year-level')
				@endif
			@endif
		</div>
	</div>
</section>
@endsection