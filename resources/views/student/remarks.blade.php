@extends('layouts.app')

@section('title') Student @endsection

@section('headside')
    @include('student.includes.header')
    @include('student.includes.side-menu')
@endsection


@section('content')
<p><strong>Remarks</strong></p>
<section class="section">
	<div class="row">
		<div class="col-md-12">
			@include('includes.all')
			<button type="button" class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
			<div id="printableArea">

				<h3 class="text-center showOnPrint">Internation Computer Technology Colleges</h3>
				<p class="text-center showOnPrint">Your Gateway to a Global Job Opportunity</p>
				<p class="text-center showOnPrint">2<sup>nd</sup> of AA building, Barangay Sto Cristo, Tarlac City</p>
				<p class="showOnPrint"><strong>{{ ucwords(Auth::user()->firstname . ' ' . Auth::user()->lastname) }} - {{ Auth::user()->student_number }}</strong></p>
				<div class="remarks">
					<p>{{ $sem->name }} | {{ $ay->from . '-' . $ay->to }}</p>
					<p>Enrolled in {{ $program->code }} - {{ $program->description }}</p>
					<p>Remark: <strong>
						@if(count($remark) > 0)
							@if($remark->remarks == 1)
							Competent
							@else
							Not Yet Competent
							@endif
						@else
						No Remark
						@endif
					</strong></p>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection