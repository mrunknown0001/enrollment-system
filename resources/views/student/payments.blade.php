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
							<th></th>
							<th>Amount</th>
							<th>Assessment Date</th>
							<th>Payment Date</th>
						</tr>
					</thead>
					<tbody>
						@foreach($payments as $p)
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						
					</tfoot>
				</table>
			@else
				<p>No payment made</p>
			@endif
		</div>
	</div>
</section>
@endsection