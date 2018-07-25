@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
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
                    <div id="printableArea">
                        @include('includes.all')
                        <button type="button" onclick="window.print()" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
    					@if($assessment->paid == 0)
    						<p id="hideOnPrint">Status: <strong>Unpaid</strong></p>
                            <div class="courseAssessment2">
        						@if($assessment->course_id != null)
        							@include('admin.includes.assessment-course')
        						@else
        							@include('admin.includes.assessment-program')
        						@endif
                            </div>
    					@else
    						<p id="hideOnPrint">Status: <strong>Paid</strong></p>
                            <div class="courseAssessment2">
        						@if($assessment->course_id != null)
        							@include('admin.includes.assessment-course')
        						@else
        							@include('admin.includes.assessment-program')
        						@endif
                            </div>
    					@endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection