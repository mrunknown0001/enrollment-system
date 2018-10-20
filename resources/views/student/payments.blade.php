@extends('layouts.app')

@section('title') Student @endsection

@section('headside')
    @include('student.includes.header')
    @include('student.includes.side-menu')
@endsection


@section('content')
<p><strong>Payments</strong></p>
<section class="section">
	<div class="row">
		<div class="col-md-12">
			@include('includes.all')

			@if(count($payments) > 0)
				<table class="table hovered">
					<thead>
						<tr>
							<th>Paypal Payment ID</th>
							<th>Amount</th>
							<th>Assessment Date</th>
							<th>Payment Date</th>
						</tr>
					</thead>
					<tbody>
						@foreach($payments as $p)
						<tr>
							<td>{{ $p->payment_id }}</td>
							<td>&#8369; {{ $p->amount }}</td>
							<td>
								@if($p->assessment_id != null)
									{{ date('F j, Y g:i:s a', strtotime($p->assessment->created_at)) }}
								@else
									N/A
								@endif
							</td>
							<td>{{ date('F j, Y g:i:s a', strtotime($p->created_at)) }}</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						
					</tfoot>
				</table>
			@else
				<p class="text-center">No payment made</p>
			@endif
		</div>
	</div>
</section>
@endsection