@extends('layouts.app')

@section('title') Registrar @endsection

@section('headside')
    @include('registrar.includes.header')
    @include('registrar.includes.side-menu')
@endsection


@section('content')
<section class="section">
    <div class="row">
        <div class="col-md-12">
            <p><a href="{{ route('registrar.view.courses') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Courses</a></p>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Course Year Level </p>
                    </div>
                </div>
                <div class="card-block">
                	@include('includes.all')
					@if(count($yl) > 0)
						@foreach($yl as $y)
							<p><a href="{{ route('registrar.view.course.year.level.enrolled', ['course_id' => $course->id, 'yl_id' => $y->id]) }}">{{ $y->name }} - {{ $course->title }}</a></p>
						@endforeach
					@else
						<p class="text-center">No Year Level</p>
					@endif
                </div>
                <div class="card-footer"> <small>Course Year Level</small> </div>
            </div>
        </div>
    </div>
</section>
@endsection