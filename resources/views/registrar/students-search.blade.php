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
					<input type="text" name="keyword" id="keyword" class="form-control boxed" placeholder="Name or Student No." required="">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-search"></i> Go!</button>
					</span>
				</div>
			</form>
			
			@if(count($students) > 0)
			<table class="table table-hover">
				<thead>
					<th class="text-center">Name</th>
					<th class="text-center">Student Number</th>
					<th class="text-center">Action</th>
				</thead>
				<tbody>
					@foreach($students as $s)
						<tr>
							<td>{{ ucwords($s->lastname . ', ' . $s->firstname) }}</td>
							<td class="text-center">{{ $s->student_number }}</td>
							<td class="text-center">
								@if($s->info->enrolling_for == 1)
								<a href="{{ route('regitrar.student.add.credits', ['id' => $s->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Credits</a>
								@endif
								<a href="{{ route('registrar.view.student.details', ['id' => $s->id, 'sn' => $s->student_number]) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View Info</a>
							</td>
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