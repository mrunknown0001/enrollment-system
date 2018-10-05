@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Programs</strong></p>
@include('includes.all')

<section class="section">
    <div class="row">
        <div class="col-md-12">
			<a href="{{ route('admin.add.program') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Program</a>
			
			@if(count($programs) > 0)
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Title</th>
						<th>Code</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($programs as $p)
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
							                    <i class="fa fa-info"></i> Program Info</h4>
							                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							                    <span aria-hidden="true">&times;</span>
							                </button>
							            </div>
							            <div class="modal-body">
											<p>Title: <strong>{{ ucwords($p->title) }}</strong></p>
											<p>Code: <strong>{{ strtoupper($p->code) }}</strong></p>
											<p>Description: <strong>{{ $p->description }}</strong></p>
											<p>Effectivity: <strong>{{ $p->from && $p->to ? date('F j, Y', strtotime($p->from)) . '-' . date('F j, Y', strtotime($p->to)) : 'N/A' }}</strong></p>
											<p>Hours: <strong>{{ $p->hours ? $p->hours : 'N/A' }}</strong></p>
											<p>Tuition Fee: <strong>&#8369; {{ $p->tuition_fee ? $p->tuition_fee : 'N/A' }}</strong></p>
							            </div>
							            <div class="modal-footer">
							                <small>Program Info</small>
							            </div>
							        </div>
							    </div>
							</div>

							<a href="{{ route('admin.update.program', ['id' => $p->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Update</a>
						</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					
				</tfoot>
			</table>
			@else
			<p class="text-center"><em>No Programs Available</em></p>
			@endif

        </div>
    </div>
</section>

@endsection