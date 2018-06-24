@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Students</strong></p>
@include('includes.all')

@if(count($students) > 0)
<table class="table table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Student Number</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($students as $s)
		<tr>
			<td>{{ ucwords($s->lastname . ', ' . $s->firstname) }}</td>
			<td>{{ $s->student_number }}</td>
			<td><button class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View</button></td>
		</tr>
		@endforeach
	</tbody>
	<tfoot>
		
	</tfoot>
</table>
@else
<p class="text-center"><em>No Student Found!</em></p>
@endif

{{ $students->links() }}
@endsection