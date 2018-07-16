@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><a href="{{ route('admin.subjects') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Subjects</a></p>
<p><strong>Select Subjects</strong></p>
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
					<form action="{{ route('admin.select.subjects.post') }}" method="POST">
						{{ csrf_field() }}
					@foreach($subjects as $s)
					<tr>
						<td><input type="checkbox" name="subjects[]" id="subject-{{ $s->id }}" value="{{ $s->id }}" {{ $s->active == 1 ? 'checked' : '' }}></td>
						<td><label for="subject-{{ $s->id }}">{{ strtoupper($s->code) }}</label></td>
						<td><label for="subject-{{ $s->id }}">{{ ucwords($s->description) }}</label></td>
					</tr>
					@endforeach
					<tr>
						<td><button type="submit" class="btn btn-primary">Save Selected</button></td>
					</tr>
					</form>
				</tbody>
				<tfooter>
					
				</tfooter>
			</table>
			@else
			<p class="text-center"><em>No Subject Available</em></p>
			@endif

        </div>
    </div>
</section>

@endsection