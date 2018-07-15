@extends('layouts.app')

@section('title') Student @endsection

@section('headside')
    @include('student.includes.header')
    @include('student.includes.side-menu')
@endsection


@section('content')
<p><strong>Remarks</strong></p>
<section class="section">
	<div class="row">
		<div class="col-md-12">
			@include('includes.all')
			<p>{{ $sem->name }} | {{ $ay->from . '-' . $ay->to }}</p>
			<p>Enrolled in {{ $program->code }} - {{ $program->description }}</p>
			<p>Remark: <strong>
				@if($remark->remarks == 1)
				Competent
				@else
				Not Yet Competent
				@endif
			</strong></p>
		</div>
	</div>
</section>
@endsection