@extends('layouts.app')

@section('title') Registrar @endsection

@section('headside')
    @include('registrar.includes.header')
    @include('registrar.includes.side-menu')
@endsection


@section('content')
<section class="section">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> {{ $yl->name }} {{ $course->title }} Students </p>
                    </div>
                </div>
                <div class="card-block">
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
										<td><a href="#" class="btn btn-primary"><i class="fa fa-eye"></i> View Info</a></td>
									</tr>
								@endforeach
							</tbody>
							<tfoot>
								
							</tfoot>
						</table>
					@else
						<p>No Students Enrolled</p>
					@endif
                </div>
                <div class="card-footer"> <small>Course Year Level Enrolled Students</small> </div>
            </div>
        </div>
    </div>
</section>
@endsection