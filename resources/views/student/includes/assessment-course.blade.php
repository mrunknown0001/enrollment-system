<p><strong>{{ Auth::user()->info->course->title }}</strong></p>
<p><strong>{{  $assessment->semester->name }}</strong></p>
<p><strong>{{ $assessment->academic_year->from . '-' . $assessment->academic_year->from }}</strong></p>
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