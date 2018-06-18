@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
@include('includes.all')
<p><a href="#" class="btn btn-primary">Add Cashier</a></p>

@if(count($cashiers) > 0)
<table class="table table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Username</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		
	</tbody>
	<tfoot>
		
	</tfoot>
</table>
@else
<p class="text-center"><em>No Cashier Found!</em></p>
@endif

{{ $cashiers->links() }}
@endsection