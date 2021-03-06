@extends('layouts.app')

@section('title') Cashier @endsection

@section('headside')
    @include('cashier.includes.header')
    @include('cashier.includes.side-menu')
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
							<th>Price</th>
							<th>Student Name</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						@foreach($payments as $p)
							<tr>
								<td>{{ $p->payment_id }}</td>
								<td>
									@if($p->assessment_id != null)
										<a href="{{ route('cashier.view.assessment.details', ['id' => $p->assessment->id]) }}">{{ $p->assessment->assessment_number }}</a>
									@else
										N/A
									@endif
								</td>
								<td>&#8369; {{ $p->amount }}</td>
								<td>{{ ucwords($p->student->firstname . ' ' . $p->student->lastname) }}</td>
								<td>{{ date('F j, Y g:i:s a', strtotime($p->created_at)) }}</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						
					</tfoot>
				</table>
			@else
				<p>No Payments!</p>
			@endif
        </div>
    </div>
</section>
@endsection