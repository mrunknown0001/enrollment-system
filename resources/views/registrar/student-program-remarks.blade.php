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
                        <p class="title"> Student Remark </p>
                    </div>
                </div>
                <div class="card-block">
                	@include('includes.all')
					<p>{{ $program->code }} - {{ $program->description }}</p>
					<p>{{ ucwords($student->firstname . ' ' . $student->lastname) }} - {{ $student->student_number }}</p>
					<p>
						@if($remark->remarks == 1)
						<strong>The Student is Competent</strong>
						@else
						<strong>The Student is Not Yet Competent</strong>
						@endif
					</p>
                </div>
                <div class="card-footer"> <small> Student Remark </small> </div>
            </div>
        </div>
    </div>
</section>
@endsection