@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>{{ $curriculum->name }}</strong></p>
@include('includes.all')
<section class="section">
    <div class="row">
		<div class="col-md-12">
			<a href="{{ route('admin.view.curriculum') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Curriculum</a>

			<table class="table table-bordered table-hover table-striped">
				<thead>
					<th>Year Level &amp; and Semester</th>
					<th>Subject Code</th>
					<th>Subject Description</th>
					<th>Unit</th>
				</thead>
				<tbody>
					@if($f_first_sem != NULL)
						@foreach($f_first_sem as $f)
							<tr>
								<td>First Year - First Semester</td>
								<td>{{ $f['code'] }}</td>
								<td>{{ $f['description'] }}</td>
								<td>{{ $f['unit'] }}</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td>First Year First Semester</td>
							<td></td>
							<td></td>
						</tr>
					@endif



					@if($f_second_sem != NULL)
						@foreach($f_second_sem as $f)
							<tr>
								<td>First Year - Second Semester</td>
								<td>{{ $f['code'] }}</td>
								<td>{{ $f['description'] }}</td>
								<td>{{ $f['unit'] }}</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td>First Year Second Semester</td>
							<td></td>
							<td></td>
						</tr>
					@endif



					@if($s_first_sem != NULL)
						@foreach($s_first_sem as $f)
							<tr>
								<td>Second Year - First Semester</td>
								<td>{{ $f['code'] }}</td>
								<td>{{ $f['description'] }}</td>
								<td>{{ $f['unit'] }}</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td>Second Year First Semester</td>
							<td></td>
							<td></td>
						</tr>
					@endif


					@if($s_second_sem != NULL)
						@foreach($s_second_sem as $f)
							<tr>
								<td>Second Year - Second Semester</td>
								<td>{{ $f['code'] }}</td>
								<td>{{ $f['description'] }}</td>
								<td>{{ $f['unit'] }}</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td>Second Year Second Semester</td>
							<td></td>
							<td></td>
						</tr>
					@endif

				</tbody>
			</table>
		</div>
    </div>
</section>
@endsection