@extends('layouts.app')

@section('title') Student @endsection

@section('headside')
    @include('student.includes.header')
    @include('student.includes.side-menu')
@endsection


@section('content')
<p><strong>Grades</strong></p>
<section class="section">
	<div class="row">
		<div class="col-md-12">
			@include('includes.all')


		</div>
	</div>
</section>
@endsection