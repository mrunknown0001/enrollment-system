@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Courses</strong></p>
@include('includes.all')

<section class="section">
    <div class="row">
        <div class="col-md-12">
			<a href="{{ route('admin.add.course') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Course</a>
			
			@if(count($courses) > 0)
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Title</th>
						<th>Code</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($courses as $p)
					<tr>
						<td>{{ ucwords($p->title) }}</td>
						<td>{{ strtoupper($p->code) }}</td>
						<td>
							<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#program-{{ $p->id }}"><i class="fa fa-eye"></i> View</button>

							<div class="modal fade" id="program-{{ $p->id }}">
							    <div class="modal-dialog" role="document">
							        <div class="modal-content">
							            <div class="modal-header">
							                <h4 class="modal-title">
							                    <i class="fa fa-info"></i> Course Info</h4>
							                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							                    <span aria-hidden="true">&times;</span>
							                </button>
							            </div>
							            <div class="modal-body">
											<p>Title: <strong>{{ ucwords($p->title) }}</strong></p>
											<p>Code: <strong>{{ strtoupper($p->code) }}</strong></p>
											<p>DescriptioN: <strong>{{ $p->description }}</strong></p>
							            </div>
							            <div class="modal-footer">
							                <small>Course Info</small>
							            </div>
							        </div>
							    </div>
							</div>

							<a href="{{ route('admin.update.course', ['id' => $p->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Update</a>
						</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					
				</tfoot>
			</table>
			@else
			<p class="text-center"><em>No Course Available</em></p>
			@endif

        </div>
    </div>
</section>

@endsection