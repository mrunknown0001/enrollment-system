@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Students Enrolled in {{ $subject->code }} - {{ $subject->description }}</strong></p>
<p>Numbers of Group: {{ count($gn) }} | Total Students: {{ count($enrolled) }} &nbsp; <a href="{{ route('admin.manage.subject.students.group', ['id' => $subject->id]) }}" class="btn btn-primary btn-sm">Manage Groups</a></p>

@include('includes.all')

@if(count($students) > 0)
<table class="table table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Student Number</th>
			<th>Year Level</th>
		</tr>
	</thead>
	<tbody>
		@foreach($students as $s)
		<tr>
			<td>{{ ucwords($s->lastname . ', ' . $s->firstname) }}</td>
			<td>{{ $s->student_number }}</td>
			<td>{{ $subject->yl->name }}</td>
		</tr>
		@endforeach
	</tbody>
	<tfoot>
		
	</tfoot>
</table>
@else
<p class="text-center"><em>No Student Found!</em></p>
@endif
@endsection