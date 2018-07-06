@extends('layouts.app')

@section('title') Registrar @endsection

@section('headside')
    @include('registrar.includes.header')
    @include('registrar.includes.side-menu')
@endsection


@section('content')
<p><strong>Courses</strong></p>
@include('includes.all')
<section class="section">
    <div class="row">
        <div class="col-md-12">
			@if(count($courses) > 0)
				@foreach($courses as $c)
					<p><a href="{{ route('registrar.view.course.year.level', ['id' => $c->id]) }}">{{ $c->title }}</a></p>
				@endforeach
			@else
				<p>No Available Course</p>
			@endif
        </div>
    </div>
</section>
@endsection