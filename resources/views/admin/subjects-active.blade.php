@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><a href="{{ route('admin.subjects') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Subjects</a></p>
<p><strong>Active Subjects</strong></p>
@include('includes.all')

<section class="section">
    <div class="row">
        <div class="col-md-12">
			
			@if(count($subjects) > 0)
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Code</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($subjects as $s)
					<tr>
						<td>@if($s->active == 1)<span class="dot"></span>@endif {{ strtoupper($s->code) }}</td>
						<td>{{ ucwords($s->description) }}</td>
						<td>
							<a href="{{ route('admin.view.enrolled.students.subject', ['id' => $s->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View Students</a>
						</td>
					</tr>
					@endforeach
				</tbody>
				<tfooter>
					
				</tfooter>
			</table>
			<p>{{ $subjects->links() }}</p>
			@else
			<p class="text-center"><em>No Subject Available</em></p>
			@endif

        </div>
    </div>
</section>

@endsection