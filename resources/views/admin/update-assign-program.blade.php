@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')

<section class="section">
    <div class="row">
        <div class="col-md-8">
			
			@if(count($programs) > 0)
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Update Assign Program to {{ ucwords($faculty->firstname . ' ' . $faculty->lastname) }}</p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')
					
					<form action="{{ route('admin.update.faculty.load.programs.post') }}" method="POST" role="form">
						{{ csrf_field() }}
						<input type="hidden" name="faculty_id" value="{{ $faculty->id }}">
                        <input type="hidden" name="program_assignment_id" value="{{ $pa->id }}">
						@foreach($programs as $p)
						<div class="form-group">
							<input type="checkbox" name="programs[]" id="program{{ $p->id }}" value="{{ $p->id }}">
							<label for="program{{ $p->id }}">{{ $p->title }}</label>
						</div>
						@endforeach
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Update Assign Program</button>
						</div>
					</form>
                </div>
                <div class="card-footer"> <small>Update Assign Program</small> </div>
            </div>
            @else
			<p>No Available Programs!</p>
            @endif
		
        </div>
    </div>
</section>

@endsection