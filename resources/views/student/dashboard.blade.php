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

		@if(count($courses) > 0 && count($programs) > 0)
			@if(Auth::user()->info->enrolling_for == null) 
				@include('student.includes.set-enrollment')
			@else
				@if(Auth::user()->info->enrolling_for == 1 && Auth::user()->info->year_level == null)
					@include('student.includes.select-year-level')
				@elseif(Auth::user()->info->enrolling_for == 1 && Auth::user()->info->year_level != null)
					{{-- check if the student is enrolled --}}
					@if(Auth::user()->enrollment_status->where('active', 1)->first())
						<p>Enrolled in a course.</p>
						<p>Show data of enrollment</p>
					@else
						{{-- check if what year level is active in enrollment --}}
						@if(Auth::user()->info->year_level == $yl->id)
							{{-- check if enrolled for course applicable for second year --}}
							@if(Auth::user()->info->course_id == null)
								<p><em>Not enrolled in any course.</em></p>
							@else
								<a href="{{ route('student.enroll') }}">Click here to enroll</a>
							@endif
						@else
							<p><em>Enrollment for Your Year Level Not Active</em></p>
						@endif

					@endif
				@elseif(Auth::user()->info->enrolling_for == 2)
					{{-- check if the student is enrolled --}}
					@if(Auth::user()->enrollment_status->where('active', 1)->first())
						<p>Enrolled in Program</p>
						<p>Show data of Program</p>
					@else
						<p><em>Not Enrolled in any Program</em></p>
						<a href="{{ route('student.enroll') }}">Click here to enroll</a>
					@endif
				@endif
			@endif
		@else
		<p><em>Enrollment Not Active</em></p>
		@endif
		</div>
	</div>
</section>
@endsection