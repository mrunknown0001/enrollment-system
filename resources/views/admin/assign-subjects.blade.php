@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Assign Subjects to <u>{{ ucwords($faculty->firstname . ' ' . $faculty->lastname) . ' - ' . $faculty->id_number}}</u></strong></p>
@include('includes.all')

<section class="section">
    <div class="row">
        <div class="col-md-12">
			
			@if(count($subjects) > 0)
			<table class="table table-hover">
				<thead>
					<tr>
						<th></th>
						<th>Code</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>
					<form action="{{ route('admin.add.subject.load.faculty.post') }}" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="faculty_id" value="{{ $faculty->id }}">
					@foreach($subjects as $s)
						@if($s->active == 1)
							<tr>
								<td><input type="checkbox" name="subjects[]" id="subject-{{ $s->id }}" value="{{ $s->id }}"></td>
								<td><label for="subject-{{ $s->id }}">{{ strtoupper($s->code) }}</label></td>
								<td><label for="subject-{{ $s->id }}">{{ ucwords($s->description) }}</label></td>
							</tr>
						@endif
					@endforeach
					<tr>
						<td><button type="submit" class="btn btn-primary">Assign Selected</button></td>
					</tr>
					</form>
				</tbody>
				<tfooter>
					
				</tfooter>
			</table>
			@else
			<p class="text-center"><em>No Active Subject Available</em></p>
			@endif

        </div>
    </div>
</section>

@endsection