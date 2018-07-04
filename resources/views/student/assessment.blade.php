@extends('layouts.app')

@section('title') Student @endsection

@section('headside')
    @include('student.includes.header')
    @include('student.includes.side-menu')
@endsection


@section('content')
<p><strong>Assessment</strong></p>
<section class="section">
	<div class="row">
		<div class="col-md-12">
			@if(count($assessment) > 0)
				<button onclick="window.print()">print</button>
				@if($assessment->paid == 0)
					@if($assessment->course_id != null)
						@include('student.includes.assessment-course')
						@if($assessment->paid == 0)
							@include('student.includes.assessment-payment')
						@endif
					@else
						@include('student.includes.assessment-program')
						@if($assessment->paid == 0)
							@include('student.includes.assessment-payment')
						@endif
					@endif
				@else
					<p>Assessment Paid</p>
					@if($assessment->course_id != null)
						@include('student.includes.assessment-course')
					@else
						@include('student.includes.assessment-program')
					@endif
				@endif
			@else
				<p>No Assessment</p>
			@endif
		</div>
	</div>
</section>
@endsection