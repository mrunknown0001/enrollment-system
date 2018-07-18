@extends('layouts.app')

@section('title') Registrar @endsection

@section('headside')
    @include('registrar.includes.header')
    @include('registrar.includes.side-menu')
@endsection


@section('content')
<p><strong>Student Search Result</strong></p>
@include('includes.all')
<section class="section">
    <div class="row">
        <div class="col-md-12">
			<form action="{{ route('registrar.search.students') }}" method="GET" class="form-inline" autocomplete="off">
				<div class="input-group">
					<input type="text" name="keyword" id="keyword" class="form-control boxed" placeholder="Name or Student Number" required="">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-search"></i> Go!</button>
					</span>
				</div>
			</form>
			
			@if(count($students) > 0)
			<table class="table table-hover">
				<thead>
					<th>Name</th>
					<th>Student Number</th>
					<th>Action</th>
				</thead>
				<tbody>
					@foreach($students as $s)
						<tr>
							<td>{{ ucwords($s->lastname . ', ' . $s->firstname) }}</td>
							<td>{{ $s->student_number }}</td>
							<td><a href="{{ route('registrar.view.student.details', ['id' => $s->id, 'sn' => $s->student_number]) }}" class="btn btn-primary"><i class="fa fa-eye"></i> View Info</a></td>
						</tr>
					@endforeach
				</tbody>
				<tfoot>
					
				</tfoot>
			</table>
			@else
				<p class="text-center">No Student Matched!</p>
			@endif
        </div>
    </div>
</section>
@endsection