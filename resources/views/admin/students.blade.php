@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Students</strong>
<form action="{{ route('admin.student.search') }}" method="GET" class="form-inline" autocomplete="off">
	<div class="input-group">
		<input type="text" name="keyword" id="keyword" class="form-control boxed" placeholder="Name or Student Number" required="">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-search"></i> Go!</button>
		</span>
	</div>
</form>
</p>
<p>
	Current: <strong>{{ $max->limit }} students</strong> <a href="{{ route('admin.set.max.student.number') }}" class="btn btn-primary">Set Max Students per Subject Class</a>
</p>
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
			<td>
				<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#info-{{ $s->student_number }}"><i class="fa fa-eye"></i> View</button>
				<div class="modal fade" id="info-{{ $s->student_number }}">
				    <div class="modal-dialog" role="document">
				        <div class="modal-content">
				            <div class="modal-header">
				                <h4 class="modal-title">
				                    <i class="fa fa-info"></i> Student Info</h4>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                    <span aria-hidden="true">&times;</span>
				                </button>
				            </div>
				            <div class="modal-body">
				            	@if(count($s->enrollment_status) > 0)
			                         
			                        @if($s->info->course_id != null)
										<p><a href="{{ route('admin.view.student.grades', ['id' => $s->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View Grades</a></p>
			                        	<p>
			                            Enrolled in {{ $s->info->course->title }} - 
			                            @if($s->info->year_level == 1)
			                                First Year
			                            @else
			                                Second Year
			                            @endif
				                        </p>
			                        @else
			                        	<p><a href="{{ route('admin.view.student.remarks', ['id' => $s->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View Remark</a></p>
			                            <p>Enrolled in {{ $s->info->program->title }}</p>
			                        @endif
			                     @else
									<p>Not Enrolled</p>
			                     @endif
								<p>Name: <strong>{{ ucwords($s->firstname . ' ' . $s->lastname) }}</strong></p>
								<p>Student Number: <strong>{{ $s->student_number }}</strong></p>
								<p>Mobile Number: <strong>{{ $s->mobile_number }}</strong></p>
								<p>Date of Birth: <strong>{{ date('F j, Y', strtotime($s->info->date_of_birth)) }}</strong>
								</p>
								<p>Place of Birth: <strong>{{ ucwords($s->info->place_of_birth) }}</strong></p>
								<p>Address: <strong>{{ ucwords($s->info->address) }}</strong></p>
								<p>Nationality: <strong>{{ ucwords($s->info->nationality) }}</strong></p>
								@if(!empty($s->info->sy_admitted))
								<p>AY Admitted: <strong>{{ $s->info->sy_admitted->from . '-' . $s->info->sy_admitted->to }}</strong></p>
								@endif
			                    <p>School Last Attended: <strong>{{ ucwords($s->info->school_last_attended) }}</strong></p>
			                    <p>Date Graduated: <strong>{{ $s->info->date_graduated }}</strong></p>
			                    <p>Status: <strong>
			                    	@if($s->info->graduated == 1)
									Graduted
			                    	@else
									Student
			                    	@endif
			                    </strong></p>
				            </div>
				            <div class="modal-footer">
				                <small>Student Info</small>
				            </div>
				        </div>
				    </div>
				</div>
			</td>
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