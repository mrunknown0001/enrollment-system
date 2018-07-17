@extends('layouts.app')

@section('title') Student @endsection

@section('headside')
    @include('student.includes.header')
    @include('student.includes.side-menu')
@endsection


@section('content')
<p><strong>{{ $sem->name }} | {{ $ay->from . '-' . $ay->to }}</strong></p>
<section class="section">
	<div class="row">
		<div class="col-md-12">
			@include('includes.all')
			
			@if(count($equiv) > 0)
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Subject Code</th>
							<th>Units</th>
							<th>Grades</th>
							<th>Remarks</th>
						</tr>
					</thead>
					<tbody>
						@foreach($subjects as $sub)
							<tr>
								<td>{{ $sub->code }}</td>
								<td>{{ $sub->units }}</td>
							@foreach($equiv as $e)
								@if($sub->id == $e['subject_id'])
								<td>{{ $e['equivalent'] }}</td>
								<td>
									@if($e['equivalent'] <= 3)
									Passed
									@else
									Failed
									@endif
								</td>
								@endif
							@endforeach
							</tr>
						@endforeach
					</tbody>
				</table>
			@else
				<p>No Data Available!</p>
			@endif

		</div>
	</div>
</section>
@endsection