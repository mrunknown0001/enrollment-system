@extends('layouts.app')

@section('title') Student @endsection

@section('headside')
    @include('student.includes.header')
    @include('student.includes.side-menu')
@endsection


@section('content')
<p><strong>Program</strong></p>
<section class="section">
	<div class="row">
		<div class="col-md-12">
			@include('includes.all')
			
			@if(Auth::user()->enrollment_status->where('active', 1)->first())
				<p class="text-center">Currently Enrolled to {{ $program->title }}</p>
			@else
				{{-- check if there is an active assessment --}}
				@if(Auth::user()->assessment->where('active', 1)->first())
					<p class="text-center">Please pay the assessment</p>
				@else
					<p class="text-center">No program enrolled</p>
				@endif
			@endif
		</div>
	</div>
@endsection