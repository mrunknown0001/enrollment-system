@extends('layouts.app')

@section('title') Student @endsection

@section('headside')
    @include('student.includes.header')
    @include('student.includes.side-menu')
@endsection


@section('content')
<p><strong>Enrollment</strong></p>
<section class="section">
	<div class="row">
		<div class="col-md-12">
			@include('includes.all')
			
			@if(Auth::user()->info->enrolling_for == 1)
				{{-- check if enrolled in a course --}}

			@else
				{{-- check if enrolled or not in any program --}}
				@if(Auth::user()->enrollment_status->where('active', 1)->first())
					<p>Currently Enrolled to {{ Auth::user()->enrollment_status->program->title }}</p>
				@else
					{{-- check if there is an active assessment --}}
					@if(Auth::user()->assessment->where('active', 1)->first())
						<p>Assessment Not Paid. Please Go to Assessment</p>
					@else
					<div class="row">
						<div class="col-md-8">
				            <div class="card card-primary">
				                <div class="card-header">
				                    <div class="header-block">
				                        <p class="title"> Enroll to Program </p>
				                    </div>
				                </div>
				                <div class="card-block">
								<form id="signup-form" action="{{ route('student.enroll.program.post') }}" method="POST" role="form">
									{{ csrf_field() }}
								@foreach($enroll as $e)
									<div class="form-group">
										<p>
										<input type="radio" name="program" id="program{{ $e->id }}" value="{{ $e->id }}" required="">
										<label for="program{{ $e->id }}">{{ $e->title }}</label>
										<br>
										<label for="program{{ $e->id }}">&#8369; {{ $e->tuition_fee }}</label>
										</p>
									</div>
								@endforeach
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Enroll Selected Program</button>
									</div>
								</form>
				                </div>
				                <div class="card-footer"> <small>Enroll to Program</small> </div>
				            </div>
						</div>
					</div>

					@endif
				@endif
			@endif
		</div>
	</div>
@endsection