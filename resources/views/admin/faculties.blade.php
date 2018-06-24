@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Faculties</strong></p>
@include('includes.all')

@if(count($faculties) > 0)
<table class="table table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>ID Number</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($faculties as $f)
		<tr>
			<td>{{ ucwords($f->firstname . ' ' . $f->lastname) }}</td>
			<td>{{ $f->id_number }}</td>
			<td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#info-{{ $f->id_number }}"><i class="fa fa-eye"></i> View</button>
				<div class="modal fade" id="info-{{ $f->id_number }}">
				    <div class="modal-dialog" role="document">
				        <div class="modal-content">
				            <div class="modal-header">
				                <h4 class="modal-title">
				                    <i class="fa fa-info"></i> Faculty Info</h4>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                    <span aria-hidden="true">&times;</span>
				                </button>
				            </div>
				            <div class="modal-body">
								<p>Name: <strong>{{ ucwords($f->firstname . ' ' . $f->lastname) }}</strong></p>
								<p>ID Number: <strong>{{ $f->id_number }}</strong></p>
								<p>Mobile Number: <strong>{{ $f->mobile_number }}</strong></p>
								<p>Date of Birth: <strong>{{ date('F j, Y', strtotime($f->info->date_of_birth)) }}</strong>
								</p>
								<p>Place of Birth: <strong>{{ ucwords($f->info->place_of_birth) }}</strong></p>
								<p>Address: <strong>{{ ucwords($f->info->address) }}</strong></p>
								<p>Nationality: <strong>{{ ucwords($f->info->nationality) }}</strong></p>

				            </div>
				            <div class="modal-footer">
				                <small>Faculty Info</small>
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
<p class="text-center"><em>No Faculty Found!</em></p>
@endif

{{ $faculties->links() }}
@endsection