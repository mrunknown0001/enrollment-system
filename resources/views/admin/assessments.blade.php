@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Assessments</strong></p>
@include('includes.all')

<section class="section">
    <div class="row">
        <div class="col-md-12">
			@if(count($assessments) > 0)
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Assessment Number</th>
							<th>Student Name</th>
							<th>Paid</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						@foreach($assessments as $a)
							<tr>
								<td>
									<a href="{{ route('admin.view.assessment.details', ['id' => $a->id]) }}">{{ $a->assessment_number }}</a>
								</td>
								<td>{{ ucwords($a->student->firstname . ' ' . $a->student->lastname) }}</td>
								<td>
									@if($a->paid == 1)
										Paid
									@else
										Not Yet Paid
									@endif
								</td>
								<td>{{ date('F j, Y g:i:s a', strtotime($a->created_at)) }}</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						
					</tfoot>
				</table>

				<p>{{ $assessments->links() }}</p>
			@else
				<p>No Assessments!</p>
			@endif
        </div>
    </div>
</section>

@endsection