@extends('layouts.app')

@section('title') Student @endsection

@section('headside')
    @include('student.includes.header')
    @include('student.includes.side-menu')
@endsection


@section('content')
<p><strong>Subjects</strong></p>
<section class="section">
	<div class="row">
		<div class="col-md-12">
			@include('includes.all')

			@if(count($subjects) > 0)
				<p><strong>Currently Enrolled Subjects</strong></p>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Code</th>
							<th>Description</th>
							<th>Unit</th>
							<th>Hours</th>
						</tr>
					</thead>
					<tbody>
						@foreach($subjects as $sub)
							<tr>
								<td>{{ $sub->code }}</td>
								<td>{{ $sub->description }}</td>
								<td>{{ $sub->units }}</td>
								<td>{{ $sub->hours }}</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot></tfoot>
				</table>
			@else
				<p>No Enrolled Subjects.</p>
			@endif
		</div>
	</div>
</section>
@endsection