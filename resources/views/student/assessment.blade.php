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
						<p><strong>{{  $assessment->semester->name }}</strong></p>
						<p><strong>{{ $assessment->academic_year->from . '-' . $assessment->academic_year->from }}</strong></p>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Code</th>
									<th>Description</th>
									<th>Unit</th>
									<th>Hours</th>
								</tr>
							</thead>
							<tbody>
								@foreach($subjects as $sub)
									<tr>
										<td>{{ $sub->code }}</td>
										<td>{{ $sub->description }}</td>
										<td>{{ $sub->units }}</td>
										<td>{{ $sub->hours }}</td>
									</tr>
								@endforeach
							</tbody>
							<tfoot></tfoot>
						</table>
						<hr>
						<p>Total: <strong>&#8369; {{ $assessment->total }}</strong></p>
						<hr>
						<form action="{{ route('student.pay.with.paypal.post') }}" method="POST">
							{{ csrf_field() }}
							<input type="hidden" name="amount" value="{{ $assessment->total }}">
							<button class="btn" style="background-color:transparent" type="submit"><img src="{{ asset('uploads/imgs/paypal_pay_now.png') }}" height="35px" width="150px"></button>
						</form>
					@else
						<p>Assessment Not Paid</p>
						<p>Assessment for <strong>{{ $assessment->program->title }}</strong></p>
						<p>Tuition Fee: <strong>&#8369; {{ $assessment->tuition_fee }}</strong></p>
						<p>Miscellaneous Fee: <strong>&#8369; {{ $assessment->misc_fee }}</strong></p>
						<hr>
						<p>Total: <strong>&#8369; {{ $assessment->total }}</strong></p>
						<hr>
						<form action="{{ route('student.pay.with.paypal.post') }}" method="POST">
							{{ csrf_field() }}
							<input type="hidden" name="amount" value="{{ $assessment->total }}">
							<button class="btn" style="background-color:transparent" type="submit"><img src="{{ asset('uploads/imgs/paypal_pay_now.png') }}" height="35px" width="150px"></button>
						</form>
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