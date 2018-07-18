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
			@if($es == true)
				@if(count($courses) > 0 && count($programs) > 0)
					@if(Auth::user()->info->enrolling_for == null) 
						@include('student.includes.set-enrollment')
					@else
						@if(Auth::user()->info->enrolling_for == 1 && Auth::user()->info->year_level == null)
							@include('student.includes.select-year-level')
						@elseif(Auth::user()->info->enrolling_for == 1 && Auth::user()->info->year_level != null)
							{{-- check if the student is enrolled --}}
							@if(Auth::user()->enrollment_status->where('active', 1)->first())
								@include('student.includes.student-dashboard-profile')
							@else
								{{-- check if what year level is active in enrollment --}}
								@if(Auth::user()->info->year_level == $yl->id)
									{{-- check if enrolled for course applicable for second year --}}
									@if(Auth::user()->info->course_id == null)
										@if(Auth::user()->assessment->where('active', 1)->first())
											<p class="text-center">Please pay the assessment</p>
										@else
											<p class="text-center"><em>Not enrolled in any course</em></p>
											<a href="{{ route('student.enroll') }}">Click here to enroll</a>
										@endif
									@else
										<a href="{{ route('student.enroll') }}">Click here to enroll</a>
									@endif
								@else
									<p class="text-center"><em>Enrollment for Your Year Level Not Active</em></p>
								@endif

							@endif
						@elseif(Auth::user()->info->enrolling_for == 2)
							{{-- check if the student is enrolled --}}
							@if(Auth::user()->enrollment_status->where('active', 1)->first())
								@include('student.includes.student-dashboard-profile')
							@else
								@if(Auth::user()->assessment->where('active', 1)->first())
									<p class="text-center">Please pay the assessment</p>
								@else
									<p class="text-center"><em>Not Enrolled in any Program</em></p>
									<a href="{{ route('student.enroll') }}">Click here to enroll</a>
								@endif
							@endif
						@endif
					@endif
				@else
				<p class="text-center"><em>Enrollment Not Active</em></p>
				@endif
			@else
				<p class="text-center"><em>Enrollment Not Active</em></p>
			@endif
		</div>
	</div>
</section>
@endsection