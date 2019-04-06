@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Curriculum</strong></p>
@include('includes.all')
<section class="section">
    <div class="row">
		<div class="col-md-12">
			<a href="{{ route('admin.add.curriculum') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Curriculum</a>

			@if(count($curriculum) > 0)
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<th>Curriculum</th>
						<th>Description</th>
						<th>Action</th>
					</thead>
					<tbody>
						@foreach($curriculum as $c)
							<tr>
								<td>{{ $c->name }}</td>
								<td>{{ $c->description }}</td>
								<td>
									<a href="{{ route('admin.update.curriculum', ['id' => $c->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a> <a href="{{ route('admin.curriculum.courses') }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> View</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@else
				<p class="text-center">No Curriculum Available.</p>
			@endif
		</div>
    </div>
</section>
@endsection