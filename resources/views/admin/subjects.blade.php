@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Subject</strong></p>
@include('includes.all')

<section class="section">
    <div class="row">
        <div class="col-md-12">
			<a href="{{ route('admin.add.subject') }}" class="btn btn-primary">Add Subject</a>
			<a href="{{ route('admin.select.subjects') }}" class="btn btn-primary">Select Subject For Enrollment</a>
			
			@if(count($subjects) > 0)
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Code</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($subjects as $s)
					<tr>
						<td>@if($s->active == 1)<span class="dot"></span>@endif {{ strtoupper($s->code) }}</td>
						<td>{{ ucwords($s->description) }}</td>
						<td>
							<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#subject-{{ $s->id }}"><i class="fa fa-eye"></i> View</button>

							<div class="modal fade" id="subject-{{ $s->id }}">
							    <div class="modal-dialog" role="document">
							        <div class="modal-content">
							            <div class="modal-header">
							                <h4 class="modal-title">
							                    <i class="fa fa-info"></i> Subject Info</h4>
							                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							                    <span aria-hidden="true">&times;</span>
							                </button>
							            </div>
							            <div class="modal-body">
											<p>Code: <strong>{{ strtoupper($s->code) }}</strong></p>
											<p>Description: <strong>{{ $s->description }}</strong></p>
											<p>Units: <strong>{{ $s->units }}</strong></p>
											<p>Hours: <strong>{{ $s->hours }}</strong></p>
											<p>Prerequisites: <strong>
												@if($s->prerequisites != null)
													{{ $s->prereq->code }}
												@else
													No Prerequisites
												@endif
											</strong></p>
											<p>Year Level: <strong>{{ $s->year_level == 1 ? 'First Year' : 'Second Year' }}</strong></p>
							            </div>
							            <div class="modal-footer">
							                <small>Subject Info</small>
							            </div>
							        </div>
							    </div>
							</div>

							<a href="{{ route('admin.update.subject', ['id' => $s->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Update</a>
						</td>
					</tr>
					@endforeach
				</tbody>
				<tfooter>
					
				</tfooter>
			</table>
			<p>{{ $subjects->links() }}</p>
			@else
			<p class="text-center"><em>No Subject Available</em></p>
			@endif

        </div>
    </div>
</section>

@endsection