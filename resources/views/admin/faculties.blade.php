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
<section class="section">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-hover">
				<thead>
					<tr>
						<th class="text-center">Name</th>
						<th class="text-center">ID Number</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($faculties as $f)
					<tr>
						<td class="text-center">{{ ucwords($f->firstname . ' ' . $f->lastname) }}</td>
						<td class="text-center">{{ $f->id_number }}</td>
						<td class="text-center">
							<a href="{{ route('admin.add.load.faculty', ['id' => $f->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Load</a>
							@if(count($f->subject_assignments) > 0 || count($f->program_assignments) > 0)
							<a href="{{ route('admin.update.faculty.load', ['id' => $f->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Update Load</a>
							@endif
							<a href="{{ route('admin.view.faculty.details', ['id' => $f->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View</a>
							<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#remove-{{ $f->id }}"><i class="fa fa-trash"></i> Remove</button>
						</td>

						<div class="modal fade" id="remove-{{ $f->id }}">
						    <div class="modal-dialog" role="document">
						        <div class="modal-content">
						            <div class="modal-header">
						                <h4 class="modal-title">
						                    <i class="fa fa-info"></i> Remove Faculty</h4>
						                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						                    <span aria-hidden="true">&times;</span>
						                </button>
						            </div>
						            <div class="modal-body">
						                <p>Are you sure you want to remove {{ ucwords($f->firstname . ' ' . $f->lastname) }}?</p>
						                <form action="{{ route('admin.remove.faculty.post') }}" method="POST">
						                	{{ csrf_field() }}
						                	<input type="hidden" name="id" value="{{ $f->id }}">
											<div class="form-group">
												<button type="submit" class="btn btn-danger">Remove Faculty</button>
											</div>
						                </form>
						            </div>
						            <div class="modal-footer">
						                <small>Remove Faculty</small>
						            </div>
						        </div>
						    </div>
						</div>

					</tr>
					@endforeach
				</tbody>
				<tfoot>
					
				</tfoot>
			</table>
		</div>
	</div>
</section>
@else
<p class="text-center"><em>No Faculty Found!</em></p>
@endif

{{ $faculties->links() }}
@endsection