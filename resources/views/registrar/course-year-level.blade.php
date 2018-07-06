@extends('layouts.app')

@section('title') Registrar @endsection

@section('headside')
    @include('registrar.includes.header')
    @include('registrar.includes.side-menu')
@endsection


@section('content')
@include('includes.all')
<section class="section">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Course Year Level </p>
                    </div>
                </div>
                <div class="card-block">
					@if(count($yl) > 0)
						@foreach($yl as $y)
							<p><a href="#">{{ $y->name }} - {{ $course->title }}</a></p>
						@endforeach
					@else
						<p>No Year Level</p>
					@endif
                </div>
                <div class="card-footer"> <small>Course Year Level</small> </div>
            </div>
        </div>
    </div>
</section>
@endsection