@extends('layouts.app')

@section('title') Registrar @endsection

@section('headside')
    @include('registrar.includes.header')
    @include('registrar.includes.side-menu')
@endsection


@section('content')
<section class="section">
    <div class="card card-primary">
        <div class="card-header">
            <div class="header-block">
                <p class="title"> Student Add Credits to {{ ucwords($student->firstname . ' ' . $student->lastname) . ' - ' . $student->student_number }} </p>
            </div>
        </div>
        <div class="card-block">
            @include('includes.all')
			{{-- add credit form --}}
			<div class="row">
				<div class="col-md-6">
					<form id="signup-form" action="{{ route('registrar.student.add.credits.post') }}" method="POST">
						{{ csrf_field() }}
						<div class="form-group">
							<label>Select Subject</label>
							<select name="subject" id="subject" class="form-control underlined" required>
								<option value="">Select Subject</option>
								@foreach($subjects as $s)
								<option value="{{ $s->id }}">{{ strtoupper($s->code) }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Enter Grade</label>
							<input name="grade" id="grade" class="form-control underlined required" placeholder="Enter Grade">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Add Credit</button>
						</div>
					</form>
				</div>
			</div>

        </div>
        <div class="card-footer"> <small>Student Add Credits</small> </div>
    </div>
</section>
@endsection