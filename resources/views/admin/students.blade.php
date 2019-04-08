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
								<p>Date of Birth: <strong>{{ $s->info->date_of_birth != NULL ? date('F j, Y', strtotime($s->info->date_of_birth)) : ''}}</strong>
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


				<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#req-{{ $s->student_number }}">Requirements</button>
				<div class="modal fade" id="req-{{ $s->student_number }}">
				    <div class="modal-dialog" role="document">
				        <div class="modal-content">
				            <div class="modal-header">
				                <h4 class="modal-title">
				                    <i class="fa fa-info"></i> Student Update Requirements</h4>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                    <span aria-hidden="true">&times;</span>
				                </button>
				            </div>
				            <div class="modal-body">

								<form action="{{ route('admin.student.requirements.save') }}" method="POST">
									{{ csrf_field() }}
									<input type="hidden" name="student_id" value="{{ $s->id }}">
									<div class="form-group">
										<input type="checkbox" name="form_138_als" id="form_138_als" {{ $s->info->form_138_als == 1 ? 'checked' : '' }}>
										<label for="form_138_als">Form 138/ALS</label>
									</div>
									<div class="form-group">
										<input type="checkbox" name="transfer_credentials" id="transfer_credentials" {{ $s->info->transfer_credentials == 1 ? 'checked' : '' }}>
										<label for="transfer_credentials">Transfer Credentials</label>
									</div>
									<div class="form-group">
										<input type="checkbox" name="copy_of_grades" id="copy_of_grades" {{ $s->info->copy_of_grades == 1 ? 'checked' : '' }}>
										<label for="copy_of_grades">Copy of Grades</label>
									</div>
									<div class="form-group">
										<input type="checkbox" name="good_moral_char" id="good_moral_char" {{ $s->info->cert_good_moral_char == 1 ? 'checked' : '' }}>
										<label for="good_moral_char">Good Moral Character Certificate</label>
									</div>
									<div class="form-group">
										<input type="checkbox" name="birth_certificate" id="birth_certificate"  {{ $s->info->birth_certificate == 1 ? 'checked' : '' }}>
										<label for="birth_certificate">Birth Certificate</label>
									</div>
									<div class="form-group">
										<input type="checkbox" name="marriage_certificate" id="marriage_certificate"  {{ $s->info->marriage_certificate == 1 ? 'checked' : '' }}>
										<label for="marriage_certificate">Marriage Certificate</label>
									</div>
									<div class="form-group">
										<input type="checkbox" name="pictures" id="pictures"{{ $s->info->pictures == 1 ? 'checked' : '' }}>
										<label for="pictures">2x2 Pictures</label>
									</div>
									<div class="form-group">
										<button class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
									</div>
								</form>
				            </div>
				            <div class="modal-footer">
				                <small>Student Update Requirements</small>
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