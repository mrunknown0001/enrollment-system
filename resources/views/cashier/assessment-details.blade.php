@extends('layouts.app')

@section('title') Cashier @endsection

@section('headside')
    @include('cashier.includes.header')
    @include('cashier.includes.side-menu')
@endsection


@section('content')
<section class="section">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Assessment Details: {{ $assessment->assessment_number }} </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')

					@if($assessment->paid == 0)
						<p>Unpaid</p>
						@if($assessment->course_id != null)
							@include('admin.includes.assessment-course')
						@else
							@include('admin.includes.assessment-program')
						@endif
					@else
						<p>Paid</p>
						@if($assessment->course_id != null)
							@include('admin.includes.assessment-course')
						@else
							@include('admin.includes.assessment-program')
						@endif
					@endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection