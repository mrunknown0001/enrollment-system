<p><strong>{{ ucwords($assessment->student->firstname . ' ' . $assessment->student->lastname) . ' - ' . $assessment->student->student_number }}</strong></p>
<p><strong>{{ $assessment->course->title }}</strong></p>
<p><strong>{{  $assessment->semester->name }}</strong></p>
<p><strong>{{ $assessment->academic_year->from . '-' . $assessment->academic_year->from }}</strong></p>
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
<hr>
<p>Total: <strong>&#8369; {{ $assessment->total }}</strong></p>
<hr>