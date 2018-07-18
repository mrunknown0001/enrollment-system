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
        	<p><a href="{{ route('registrar.view.courses') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Courses</a></p>
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
										<td><a href="{{ route('registrar.view.student.details', ['id' => $s->id, 'sn' => $s->student_number]) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View Info</a>
										<a href="{{ route('registrar.view.course.student.grades', ['id' => $course->id, 'sid' => $s->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View Grades</a></td>
									</tr>
								@endforeach
							</tbody>
							<tfoot>
								
							</tfoot>
						</table>
					@else
						<p class="text-center">No Students Enrolled</p>
					@endif
                </div>
                <div class="card-footer"> <small>Course Year Level Enrolled Students</small> </div>
            </div>
        </div>
    </div>
</section>
@endsection