@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Schedules</strong></p>
<p><a href="{{ route('admin.add.schedule') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Schedule</a></p>
@include('includes.all')
@if(count($schedules) > 0)
<table class="table">
	<tbody>
		<tr>
			<td>Monday</td>
			@foreach($monday as $sch)
				<td class="text-center">
				{{ $sch->subject->code }}
				<br>
				{{ \App\Http\Controllers\GeneralController::get_time($sch->time_start) }}-
				{{ \App\Http\Controllers\GeneralController::get_time($sch->time_end) }}
				<br>
				<a href="#">Update</a>
				<a href="#">Remove</a>
				</td>
			@endforeach
		</tr>
		<tr>
			<td>Tuesday</td>
			@foreach($tuesday as $sch)
				<td class="text-center">
				{{ $sch->subject->code }}
				<br>
				{{ \App\Http\Controllers\GeneralController::get_time($sch->time_start) }}-
				{{ \App\Http\Controllers\GeneralController::get_time($sch->time_end) }}
				</td>
			@endforeach
		</tr>
		<tr>
			<td>Wednesday</td>
			@foreach($wednesday as $sch)
				<td class="text-center">
				{{ $sch->subject->code }}
				<br>
				{{ \App\Http\Controllers\GeneralController::get_time($sch->time_start) }}-
				{{ \App\Http\Controllers\GeneralController::get_time($sch->time_end) }}
				</td>
			@endforeach
		</tr>
		<tr>
			<td>Thursday</td>
			@foreach($thursday as $sch)
				<td class="text-center">
				{{ $sch->subject->code }}
				<br>
				{{ \App\Http\Controllers\GeneralController::get_time($sch->time_start) }}-
				{{ \App\Http\Controllers\GeneralController::get_time($sch->time_end) }}
				</td>
			@endforeach
		</tr>
		<tr>
			<td>Friday</td>
			@foreach($friday as $sch)
				<td class="text-center">
				{{ $sch->subject->code }}
				<br>
				{{ \App\Http\Controllers\GeneralController::get_time($sch->time_start) }}-
				{{ \App\Http\Controllers\GeneralController::get_time($sch->time_end) }}
				</td>
			@endforeach
		</tr>
	</tbody>
</table>
@else
<p class="text-center">No Schedules Available!</p>
@endif
@endsection