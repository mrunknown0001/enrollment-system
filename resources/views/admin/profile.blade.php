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
        <div class="col-md-6">
            <div class="card card-block">
                <div class="title-block">
                    <h3 class="title"> Admin Profile </h3>
                </div>
                
                <p>Name: <strong>{{ ucwords(Auth::guard('admin')->user()->firstname . ' ' . Auth::guard('admin')->user()->lastname) }}</strong></p>
                <p>Username: <strong>{{ strtolower(Auth::guard('admin')->user()->username) }}</strong></p>
                <p>ID Number: <strong>{{ Auth::guard('admin')->user()->id_number }}</strong></p>
                <p>Mobile Number: <strong>{{ Auth::guard('admin')->user()->mobile_number }}</strong></p>
            </div>
        </div>
    </div>
</section>

@endsection