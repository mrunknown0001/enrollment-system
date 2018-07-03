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
				@if($assessment->paid == 0)
					@if($assessment->course_id != null)
						<p><strong>{{ Auth::user()->info->course->title }}</strong></p>
						@foreach($subjects as $sub)
							<p>{{ $sub->code }}</p>
						@endforeach
						<hr>
						<p>Total: <strong>&#8369; {{ $assessment->total }}</strong></p>
						<hr>
						<p><a href="#"><img src="{{ asset('uploads/imgs/paypal_pay_now.png') }}" height="35px" width="155px"></a></p>
					@else
						<p>Assessment Not Paid</p>
						<p>Assessment for <strong>{{ $assessment->program->title }}</strong></p>
						<p>Tuition Fee: <strong>&#8369; {{ $assessment->tuition_fee }}</strong></p>
						<p>Miscellaneous Fee: <strong>&#8369; {{ $assessment->misc_fee }}</strong></p>
						<hr>
						<p>Total: <strong>&#8369; {{ $assessment->total }}</strong></p>
						<hr>
						<p><a href="#"><img src="{{ asset('uploads/imgs/paypal_pay_now.png') }}" height="35px" width="155px"></a></p>
					@endif
				@else
					<p>Assessment Paid</p>
				@endif
			@else
				<p>No Assessment</p>
			@endif
		</div>
	</div>
</section>
@endsection