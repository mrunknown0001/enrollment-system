@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Rates &amp; Fees</strong></p>
@include('includes.all')

<div class="row">
	<div class="col-md-12">
		<p>Current Unit Price: <strong>&#8369; {{ $unit_price->price }}</strong> <a href="{{ route('admin.price.per.unit.update') }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Update Price Per Unit</a></p>
		<hr>
		<p><a href="{{ route('admin.add.misc.fee') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Miscellaneous Fee</a></p>
		
		@if(count($misc) > 0)
		
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th class="text-center">Name</th>
						<th class="text-center">Amount</th>
						<th class="text-center">Payee</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($misc as $m)
						<tr>
							<td>
								{{ $m->name }}
							</td>
							<td class="text-center">
								&#8369; {{ $m->amount }}
							</td>
							<td class="text-center">
								@if($m->type == 1)
								<em>for course</em>
								@elseif($m->type == 2)
								<em>for program</em>
								@elseif($m->type == 3)
								<em>for all</em>
								@endif
							</td>
							<td class="text-center">
								<a href="{{ route('admin.update.misc.fee', ['id' => $m->id]) }}"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button></a>
								<a href="{{ route('admin.delete.misc.fee', ['id' => $m->id]) }}"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<p>

				
		@else
			<p class="text-center">No Miscellaneous Fee!</p>
		@endif

	</div>
</div>
@endsection