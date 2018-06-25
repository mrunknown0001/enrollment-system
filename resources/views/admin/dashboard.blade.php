@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Admin Dashboard</strong></p>
@include('includes.all')

<section class="section">
    <div class="row sameheight-container">
        <div class="col-md-12">
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
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="stat">
                                <div class="value"> {{ count($faculties) }} / {{ count($cashiers) }} / {{ count($registrars) }} </div>
                                <div class="name"> Faculties / Cashiers / Registrars </div>
                            </div>
                            <div class="progress stat-progress">
                                <!-- <div class="progress-bar" style="width: 25%;"></div> -->
                            </div>
                        </div>
                        <div class="col-12 col-sm-6  stat-col">
                            <div class="stat-icon">
                                <i class="fa fa-line-chart"></i>
                            </div>
                            <div class="stat">
                                <div class="value"> {{ count($subjects) }} </div>
                                <div class="name"> Subjects </div>
                            </div>
                            <div class="progress stat-progress">
                                <!-- <div class="progress-bar" style="width: 60%;"></div> -->
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 stat-col">
                            <div class="stat-icon">
                                <!-- <i class="fa fa-dollar"></i> -->
                                &#8369;
                            </div>
                            <div class="stat">
                                <div class="value"> 0 </div>
                                <div class="name"> Total Payment </div>
                            </div>
                            <div class="progress stat-progress">
                                <!-- <div class="progress-bar" style="width: 15%;"></div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection