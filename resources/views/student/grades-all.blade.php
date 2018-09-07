@extends('layouts.app')

@section('title') Student @endsection

@section('headside')
    @include('student.includes.header')
    @include('student.includes.side-menu')
@endsection


@section('content')
<section class="section">
	<div class="row">
		<div class="col-md-12" id="printableArea">
			<button onclick="window.print()" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
			<div class="gradeHeader">
				<h3 class="text-center showOnPrint">International Computer Technology Colleges</h3>
				<p class="text-center showOnPrint">Your Gateway to a Global Job Opportunity</p>
				<p class="text-center showOnPrint">2<sup>nd</sup> of AA building, Barangay Sto Cristo, Tarlac City</p>
				<p class="showOnPrint"><strong>{{ ucwords(Auth::user()->firstname . ' ' . Auth::user()->lastname) }} - {{ Auth::user()->student_number }}</strong></p>
				<p class="showOnPrint"><strong>{{ Auth::user()->info->course->title }}</strong></p>
			</div>
			@include('includes.all')
			
			<div class="gradePrint">	
			<p><strong>{{ $sem->name }} | {{ $ay->from . '-' . $ay->to }}</strong></p>
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
				<p class="text-center">No Data Available!</p>
			@endif
			</div>
			<p class="text-center showOnPrint"><em>System Generated Grades. Unofficial Grades</em></p>
		</div>
	</div>
</section>
@endsection