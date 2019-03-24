@extends('layouts.app')

@section('title') Registrar @endsection

@section('headside')
    @include('registrar.includes.header')
    @include('registrar.includes.side-menu')
@endsection


@section('content')
<p><strong>Students</strong></p>
@include('includes.all')
<section class="section">
    <div class="row">
        <div class="col-md-12">
        	<p>
        		<a href="{{ route('registrar.student.registration') }}" class="btn btn-primary"><i class="fa fa-user-plus"></i> Student Registration</a>
        	</p>
			<form action="{{ route('registrar.search.students') }}" method="GET" class="form-inline" autocomplete="off">
				<div class="input-group">
					<input type="text" name="keyword" id="keyword" class="form-control boxed" placeholder="Name or Student No." required="">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-search"></i> Go!</button>
					</span>
				</div>
			</form>
        </div>
    </div>
</section>
@endsection