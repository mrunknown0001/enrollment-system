@extends('layouts.app')

@section('title') Cashier @endsection

@section('headside')
    @include('cashier.includes.header')
    @include('cashier.includes.side-menu')
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
							<td><a href="{{ route('cashier.view.student.assessment', ['id' => $s->id]) }}" class="btn btn-primary"><i class="fa fa-eye"></i> View Assessment</a></td>
						</tr>
					@endforeach
				</tbody>
				<tfoot>
					
				</tfoot>
			</table>
			@else
				<p>No Student Matched!</p>
			@endif
        </div>
    </div>
</section>
@endsection