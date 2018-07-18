@extends('layouts.app')

@section('title') Faculty @endsection

@section('headside')
    @include('faculty.includes.header')
    @include('faculty.includes.side-menu')
@endsection


@section('content')
@include('includes.all')
<section class="section">
    <div class="row">

        <div class="col-xl-12">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Faculty Profile </p>
                    </div>
                </div>
                <div class="card-block">
                    <p>Name: <strong>{{ ucwords(Auth::guard('faculty')->user()->firstname . ' ' . Auth::guard('faculty')->user()->lastname) }}</strong></p>
                    <p>ID Number: <strong>{{ Auth::guard('faculty')->user()->id_number }}</strong></p>
                    <p>Mobile Number: <strong>{{ Auth::guard('faculty')->user()->mobile_number }}</strong></p>
                    <p><a href="{{ route('faculty.profile.update') }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Update Profile</a></p>
                </div>
                <div class="card-footer"> <small>Faculty Profile</small> </div>
            </div>
        </div>

    </div>
</section>

@endsection