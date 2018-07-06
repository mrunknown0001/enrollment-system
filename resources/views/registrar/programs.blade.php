@extends('layouts.app')

@section('title') Registrar @endsection

@section('headside')
    @include('registrar.includes.header')
    @include('registrar.includes.side-menu')
@endsection


@section('content')
<p><strong>Programs</strong></p>
@include('includes.all')
<section class="section">
    <div class="row">
        <div class="col-md-12">
			@if(count($programs) > 0)
				@foreach($programs as $p)
					<p><a href="{{ route('registrar.view.program.enrolled', ['id' => $p->id]) }}">{{ $p->title }} - {{ $p->code }}</a></p>
				@endforeach
			@else
				<p>No Available Programs</p>
			@endif
        </div>
    </div>
</section>
@endsection