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
				
				@if(Auth::user()->info->year_level == $yl->id)
					@if(Auth::user()->assessment->where('active', 1)->first())
						@if(Auth::user()->assessment->where('paid', 1)->first())
							<p class="text-center">Assessment Paid</p>
						@else
							<p class="text-center">Please pay assessment</p>
						@endif
					@else
						@if(Auth::user()->info->course_id != null)
							@if(count($subjects) > 0)
								<form action="{{ route('student.enroll.course.subject.post') }}" method="POST" role="form">
									{{ csrf_field() }}
									<div class="form-group">
										@foreach($subjects as $sub)
											<div class="row">
												<div class="col-md-8">
													<input type="checkbox" name="subjects[]" id="subject{{ $sub->id }}" value="{{ $sub->id }}">
													<label for="subject{{ $sub->id }}"><strong>{{ $sub->code }}</strong></label>
													<p><label for="subject{{ $sub->id }}">{{ $sub->description }}</label></p>		
													<hr>
												</div>	
											</div>
											
										@endforeach										
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Enroll Subjects</button>
									</div>
								</form>
							@else
							<p>No Active Subjects</p>
							@endif
						@else
							<div class="row">
								<div class="col-md-8">
						            <div class="card card-primary">
						                <div class="card-header">
						                    <div class="header-block">
						                        <p class="title"> Course Enroll </p>
						                    </div>
						                </div>
						                <div class="card-block">
										<form id="signup-form" action="{{ route('student.enroll.course.post') }}" method="POST" role="form">
											{{ csrf_field() }}
										@foreach($enroll as $e)
											<div class="form-group">
												<input type="radio" name="course" id="course{{ $e->id }}" value="{{ $e->id }}" required="">
												<label for="course{{ $e->id }}">{{ $e->title }}</label>
											</div>
										@endforeach
											<div class="form-group">
												<button type="submit" class="btn btn-primary">Enroll Course</button>
											</div>
										</form>
						                </div>
						                <div class="card-footer"> <small>Course Enroll</small> </div>
						            </div>
								</div>
							</div>
						@endif
					@endif
				@else
					<p class="text-center">Your year level not active.</p>
				@endif
				
			@else
				{{-- check if enrolled or not in any program --}}
				@if(Auth::user()->enrollment_status->where('active', 1)->first())
					<p class="text-center">Assessment Paid and Currently Enrolled to a program</p>
				@else
					{{-- check if there is an active assessment --}}
					@if(Auth::user()->assessment->where('active', 1)->where('paid', 0)->first())
						<p class="text-center">Please pay the assessment</p>
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