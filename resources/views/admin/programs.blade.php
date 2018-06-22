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
			<a href="{{ route('admin.add.program') }}" class="btn btn-primary">Add Program</a>
			
			@if(count($programs) > 0)
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Title</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
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