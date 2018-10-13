@extends('layouts.app')

@section('title') Cashier @endsection

@section('headside')
    @include('cashier.includes.header')
    @include('cashier.includes.side-menu')
@endsection


@section('content')
<p><strong>Cashier Dashboard</strong></p>
@include('includes.all')

@if($es->status == 1)
<div class="col-md-12">
  <p class="text-center">Enrollment is Active</p>  
</div>
@else
<div class="col-md-12">
    <p class="text-center">Enrollment is Inactive</p>
</div>
@endif

            <div class="card sameheight-item stats" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block">
                        
                    </div>
                    <div class="row row-sm stats-container">
                        <div class="col-12 col-sm-6 stat-col">
                            <div class="stat-icon">
                                <i class="fa fa-graduation-cap"></i>
                            </div>
                            <div class="stat">
                                <div class="value"> {{ count($students) }} </div>
                                <div class="name"> Students </div>
                            </div>
                            <div class="progress stat-progress">
                                <!-- <div class="progress-bar" style="width: 75%;"></div> -->
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 stat-col">
                            <div class="stat-icon">
                                <!-- <i class="fa fa-dollar"></i> -->
                                &#8369;
                            </div>
                            <div class="stat">
                                <div class="value"> {{ $total_payment != null ?  $total_payment : '0' }} </div>
                                <div class="name"> Total Payment </div>
                            </div>
                            <div class="progress stat-progress">
                                <!-- <div class="progress-bar" style="width: 15%;"></div> -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
@endsection