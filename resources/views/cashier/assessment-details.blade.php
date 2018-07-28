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
            <p><a href="{{ route('cashier.view.assessments') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Assessments</a></p>
            @if(count($assessment) > 0)
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Assessment Details: {{ $assessment->assessment_number }} </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')
                    <button id="hideOnPrint" type="button" onclick="window.print()" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                    <div id="printableArea">
                        <h3 class="text-center showOnPrint">Internation Computer Technology Colleges</h3>
                        <p class="text-center showOnPrint">Your Gateway to a Global Job Opportunity</p>
                        <p class="text-center showOnPrint">2<sup>nd</sup> of AA building, Barangay Sto Cristo, Tarlac City</p>
                        
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
                            <div class="courseAssessment2">
                                <p id="hideOnPrint">Status: <strong>Paid</strong></p>
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
            @else
                <p>No Assessment!</p>
            @endif
        </div>
    </div>
</section>
@endsection