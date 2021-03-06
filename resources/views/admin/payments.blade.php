@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Payments</strong></p>
@include('includes.all')
<section class="section">
    <div class="row">
        <div class="col-md-12">
			@if(count($payments) > 0)
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Paypal Payment Number</th>
							<th>Assessment Number</th>
							<th>Student Name</th>
							<th>Amount</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						@foreach($payments as $p)
							<tr>
								<td>{{ $p->payment_id }}</td>
								<td>{{ $p->assessment->assessment_number }}</td>
								<td>{{ ucwords($p->student->firstname . ' ' . $p->student->lastname) }}</td>
								<td>&#8369; {{ $p->amount }}</td>
								<td>{{ date('F j, Y g:i:s a', strtotime($p->created_at)) }}</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						
					</tfoot>
				</table>
			@else
				<p class="text-center">No Payments!</p>
			@endif
        </div>
    </div>
</section>
@endsection