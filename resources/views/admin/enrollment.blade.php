@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<!-- <p><strong>Enrollment</strong></p> -->

<section class="section">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Enrollment Settings </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')
					<form action="#" method="POST" role="form">
						{{ csrf_field() }}
						<p><strong>Programs</strong></p>
						@foreach($programs as $program)
						<div class="form-group">
							<input type="radio" name="course_id" id="program{{ $program->id }}" value="{{ $program->id }}">
							<label for="program{{ $program->id }}">{{ $program->title }}</label>
						</div>
						@endforeach
						<p><strong>Courses</strong></p>
						@foreach($courses as $course)
						<div class="form-group">
							<input type="radio" name="course_id" id="course{{ $course->id }}" value="{{ $course->id }}">
							<label for="course{{ $course->id }}">{{ $course->title }}</label>
						</div>
						@endforeach
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<select name="year_level" id="year_level" class="form-control underlined">
										<option value="">Not Applicable</option>
										@foreach($yl as $y)
										<option value="{{ $y->id }}">{{ ucwords($y->name) }}</option>
										@endforeach
									</select>									
								</div>
							</div>

						</div>
					</form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection