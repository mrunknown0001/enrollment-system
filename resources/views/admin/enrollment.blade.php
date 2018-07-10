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
			@if(session('setting_error'))
				<div class="alert alert-danger text-center top-space">
					<a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<b>{{ session('setting_error') }}</b>
				</div>
			@endif
			@if(session('setting_success'))
				<div class="alert alert-success text-center top-space">
					<a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<b>{{ session('setting_success') }}</b>
				</div>
			@endif
        	<form action="{{ route('admin.enrollment.setting.post') }}" method="POST" class="form-inline">
        		{{ csrf_field() }}
				<div class="form-group">
					<label class="checkbox-inline">
						<input type="checkbox" name="enrollment_switch" id="enrollment_switch" @if($es->status == 1) checked @endif> &nbsp; Enrollment Switch
					</label>
				</div>
				&nbsp;
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-floppy-o"></i> Save</button>
				</div>
        	</form>
        	<hr>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Enrollment </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')
                    @if(count($ay) < 1)
					<div class="alert alert-warning text-center top-space">
					<a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>No Active Academic Year. <a href="{{ route('admin.add.academic.year') }}">Click here to add.</a></strong>
					</div>
                    @endif
					<form action="{{ route('admin.save.enrollment.post') }}" method="POST" role="form">
						{{ csrf_field() }}
						<p><strong>Programs</strong></p>
						@foreach($programs as $program)
						<div class="form-group">
							<input type="checkbox" name="program[]" id="program{{ $program->id }}" value="{{ $program->id }}" {{ $program->active == 1 ? 'checked' : '' }}>
							<label for="program{{ $program->id }}">{{ $program->title }}</label>
						</div>
						@endforeach
						<p><strong>Courses</strong></p>
						@foreach($courses as $course)
						<div class="form-group">
							<input type="checkbox" name="course[]" id="course{{ $course->id }}" value="{{ $course->id }}" {{ $course->active == 1 ? 'checked' : '' }}>
							<label for="course{{ $course->id }}">{{ $course->title }}</label>
						</div>
						@endforeach
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<select name="year_level" id="year_level" class="form-control underlined">
										<option value="">Seleect Year Level</option>
										@foreach($yl as $y)
										<option value="{{ $y->id }}" {{ $y->active == 1 ? 'selected' : '' }}>{{ ucwords($y->name) }}</option>
										@endforeach
									</select>									
								</div>
							</div>

						</div>
						<div class="form-group">
							<button class="btn btn-primary"><i class="fa fa-floppy-o"></i> Activate Selected</button>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
	$("input:checkbox[name=program]:checked").each(function(){
	    yourArray.push($(this).val());
	});
</script>
@endsection