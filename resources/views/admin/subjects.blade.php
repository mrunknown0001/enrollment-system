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
			<a href="#" class="btn btn-primary">Add Subject</a>
			
			@if(count($subjects) > 0)
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Title</th>
						<th>Code</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
				<tfoot>
					
				</tfoot>
			</table>
			@else
			<p class="text-center"><em>No Subject Available</em></p>
			@endif

        </div>
    </div>
</section>

@endsection