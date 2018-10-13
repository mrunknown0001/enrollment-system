@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Rooms</strong></p>
<p><a href="{{ route('admin.add.room') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Room</a></p>
@include('includes.all')

<section class="section">

	@if(count($rooms) > 0)
	<table class="table">
		<thead>
			<tr>
				<th>Room Name</th>
				<th>Room Number</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($rooms as $r)
			<tr>
				<td>{{ ucwords($r->name) }}</td>
				<td>{{ $r->room_number != null ? $r->room_number : 'Null' }}</td>
				<td>
					<a href="{{ route('admin.update.room', ['id' => $r->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Update</a>
				</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
			
		</tfoot>
	</table>
	@else
	<p class="text-center">No rooms available</p>
	@endif
</section>

@endsection