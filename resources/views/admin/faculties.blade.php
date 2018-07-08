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
						<td>
							<a href="{{ route('admin.add.load.faculty', ['id' => $f->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Load</a>
							@if(count($f->subject_assignments) > 0 || count($f->program_assignments) > 0)
							<a href="#" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Update Load</a>
							@endif
							<a href="{{ route('admin.view.faculty.details', ['id' => $f->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View</a>
						</td>
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