@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Year Levels</strong></p>
@include('includes.all')

<section class="section">
    <div class="row">
        <div class="col-md-12">
			<a href="{{ route('admin.add.year.level') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Year Level</a>
			
			@if(count($yl) > 0)
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($yl as $y)
					<tr>
						<td>{{ ucwords($y->name) }}</td>
						<td>{{ ucwords($y->description) }}</td>
						<td><a href="{{ route('admin.update.year.level', ['id' => $y->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Update</a></td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					
				</tfoot>
			</table>
			@else
			<p class="text-center"><em>No Year Level Available</em></p>
			@endif

        </div>
    </div>
</section>


@endsection