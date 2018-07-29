@extends('layouts.app')

@section('title') Registrar @endsection

@section('headside')
    @include('registrar.includes.header')
    @include('registrar.includes.side-menu')
@endsection


@section('content')
<p><a href="{{ route('registrar.view.students') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Students</a></p>
<p><strong>Student TOR</strong></p>
@include('includes.all')
<section class="section">
	<div class="row">
		<div class="col-md-12">
			<button type="button" class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
			<div id="printableArea" class="torMargin">
				<div class="torHeader">
					<h3 class="text-center showOnPrint">1<sup>st</sup> INTERNATIONAL COMPUTER TECHNOLOGY COLLEGES</h3>
					<h3 class="text-center showOnPrint">TRANSCRIPT OF RECORDS</h3>
					
				</div>
				<p>Name: {{ ucwords($student->firstname . ' ' . $student->lastname) }}</p>
				<p>Student Number: {{ $student->student_number }}</p>
				<p>Course: {{ $course->title }}</p>
				<p>Date of Birth: {{ date('F j, Y', strtotime($student->info->date_of_birth)) }}</p>
				<p>Place of Birth: {{ ucwords($student->info->place_of_birth) }}</p>
				<p>Address: {{ $student->info->address }}</p>
				<p>Nationality: {{ $student->info->nationality }}</p>

				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center">SUBJECT CODE</th>
							<th class="text-center">DESCRIPTIVE TITLE</th>
							<th class="text-center">FINAL GRADES</th>
							<th class="text-center">UNITS</th>
						</tr>
					</thead>
					<tbody>
						@foreach($subjects as $s)
							<tr>
								<td class="text-center">{{ $s->code }}</td>
								<td class="text-center">{{ $s->description }}</td>
								@foreach($equiv as $eq)
								 	@if($s->id == $eq['subject_id'])
										<td class="text-center">{{ $eq['equivalent'] }}</td>
								 	@endif
								@endforeach
								<td class="text-center">{{ $s->units }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
@endsection