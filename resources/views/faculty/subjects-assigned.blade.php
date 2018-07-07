@extends('layouts.app')

@section('title') Faculty @endsection

@section('headside')
    @include('faculty.includes.header')
    @include('faculty.includes.side-menu')
@endsection


@section('content')
<p><strong>Subjects Assigned</strong></p>
<section class="section">
	<div class="row">
		<div class="col-md-12">
			@if(count($subjects) > 0)
				@foreach($subjects as $sub)
					<p>{{ $sub->code }}</p>
				@endforeach
			@else
				<p>No Subjects Assigned!</p>
			@endif
		</div>
	</div>
</section>
@endsection