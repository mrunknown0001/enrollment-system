@extends('layouts.app')

@section('title') Faculty @endsection

@section('headside')
    @include('faculty.includes.header')
    @include('faculty.includes.side-menu')
@endsection


@section('content')
<section class="section">
	<div class="row">
		<div class="col-md-12">
			@if(count($programs) > 0)
	            <div class="card card-primary">
	                <div class="card-header">
	                    <div class="header-block">
	                        <p class="title"> Program Assigned </p>
	                    </div>
	                </div>
	                <div class="card-block">
	                    @include('includes.all')
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Code</th>
									<th>Description</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($programs as $p)
								<tr>
									<td>{{ $p->code }}</td>
									<td>{{ $p->description }}</td>
									<td>
										<a href="{{ route('faculty.view.program.students', ['id' => $p->id]) }}" class="btn btn-primary"><i class="fa fa-eye"></i> View Students Enrolled</a>
									</td>
								</tr>
								@endforeach
								
							</tbody>
							<tfoot>
								
							</tfoot>
						</table>
	                </div>
	                <div class="card-footer"> <small>Program Assigned</small> </div>
	            </div>
			@else
				<p>No Program Assigned!</p>
			@endif


		</div>
	</div>
</section>
@endsection