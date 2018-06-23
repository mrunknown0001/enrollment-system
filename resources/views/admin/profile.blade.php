@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection

@section('content')
@include('includes.all')

<section class="section">
    <div class="row">

        <div class="col-xl-6">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Admin Profile </p>
                    </div>
                </div>
                <div class="card-block">
                    <p>Name: <strong>{{ ucwords(Auth::guard('admin')->user()->firstname . ' ' . Auth::guard('admin')->user()->lastname) }}</strong></p>
                    <p>Username: <strong>{{ strtolower(Auth::guard('admin')->user()->username) }}</strong></p>
                    <p>ID Number: <strong>{{ Auth::guard('admin')->user()->id_number }}</strong></p>
                    <p>Mobile Number: <strong>{{ Auth::guard('admin')->user()->mobile_number }}</strong></p>
                    <p><a href="{{ route('admin.profile.update') }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Update Profile</a></p>
                </div>
                <div class="card-footer"> <small>Admin Profile</small> </div>
            </div>
        </div>

    </div>
</section>

@endsection