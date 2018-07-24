<h3 class="text-center showOnPrint">Internation Computer Technology Colleges</h3>
<p class="text-center showOnPrint">Your Gateway to a Global Job Opportunity</p>
<p class="text-center showOnPrint">2<sup>nd</sup> of AA building, Barangay Sto Cristo, Tarlac City</p>
<p class="showOnPrint"><strong>{{ ucwords(Auth::user()->firstname . ' ' . Auth::user()->lastname) }} - {{ Auth::user()->student_number }}</strong></p>

<div class="courseAssessment">

<p><strong>{{ Auth::user()->info->course->title }}</strong></p>
<p><strong>{{  $assessment->semester->name }} | {{ $assessment->academic_year->from . '-' . $assessment->academic_year->from }}</strong></p>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Code</th>
			<th>Description</th>
			<!-- <th>Unit</th>
			<th>Hours</th> -->
			<th>Schedule</th>
		</tr>
	</thead>
	<tbody>
		@foreach($subjects as $sub)
			<tr>
				<td>{{ $sub->code }}</td>
				<td>{{ $sub->description }}</td>
				<!-- <td>{{ $sub->units }}</td>
				<td>{{ $sub->hours }}</td> -->
				<td>
					@if(count($sub->schedules) > 0)
						@foreach($sub->schedules as $sched)
							{{ \App\Http\Controllers\GeneralController::get_day($sched->day) }} /
							{{ $sched->room->name }} /
							{{ \App\Http\Controllers\GeneralController::get_time($sched->time_start) }}-{{ \App\Http\Controllers\GeneralController::get_time($sched->time_end) }}
							@if(!$loop->last) | @endif
						@endforeach
					@endif
				</td>
			</tr>
		@endforeach
	</tbody>
	<tfoot></tfoot>
</table>
<hr>
<p>Total: <strong>&#8369; {{ $assessment->total }}</strong></p>
<hr>

</div>