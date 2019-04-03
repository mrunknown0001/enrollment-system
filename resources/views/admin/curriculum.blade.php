@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Curriculum</strong></p>
@include('includes.all')
<section class="section">
    <div class="row">
		<div class="col-md-12">
			<a href="" class="btn btn-primary"><i class="fa fa-plus"></i> Add Curriculum</a>
		</div>
    </div>
</section>
@endsection