@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Rates &amp; Fees</strong></p>
@include('includes.all')

<div class="row">
	<div class="col-md-8">
		<p>Current Unit Price: <strong>&#8369; {{ $unit_price->price }}</strong> <a href="{{ route('admin.price.per.unit.update') }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Update Price Per Unit</a></p>
		<p><a href="{{ route('admin.add.misc.fee') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Miscellaneous Fee</a></p>
		
		@if(count($misc) > 0)
		@foreach($misc as $m)
		<p><strong>{{ $m->name }} - &#8369; {{ $m->amount }}</strong>
			@if($m->type == 1)
			<em>for course</em>
			@elseif($m->type == 2)
			<em>for program</em>
			@elseif($m->type == 3)
			<em>for all</em>
			@endif
			<a href="{{ route('admin.update.misc.fee', ['id' => $m->id]) }}"><button class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
			<a href="{{ route('admin.delete.misc.fee', ['id' => $m->id]) }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a></p>
		@endforeach
		@endif

	</div>
</div>
@endsection