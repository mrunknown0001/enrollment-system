@extends('layouts.app')

@section('title') Registrar @endsection

@section('headside')
    @include('registrar.includes.header')
    @include('registrar.includes.side-menu')
@endsection


@section('content')
<section class="section">
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Student Number: {{ $student->student_number }} </p>
                    </div>
                </div>
                <div class="card-block">
                	@include('includes.all')
					<p>Name: <strong>{{ ucwords($student->firstname . ' ' . $student->lastname) }}</strong></p>
                </div>
                <div class="card-footer"> <small>Student Details</small> </div>
            </div>
        </div>
    </div>
</section>
@endsection