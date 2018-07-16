@extends('layouts.app')

@section('title') Cashier @endsection

@section('headside')
    @include('cashier.includes.header')
    @include('cashier.includes.side-menu')
@endsection


@section('content')

<section class="section">
    <div class="row">

        <div class="col-xl-6">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Cashier Profile </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')
					<p>Name: <strong>{{ ucwords(Auth::guard('cashier')->user()->firstname . ' ' . Auth::guard('cashier')->user()->lastname) }}</strong></p>
                    <p>Username: <strong>{{ strtolower(Auth::guard('cashier')->user()->username) }}</strong></p>
                    <p>ID Number: <strong>{{ Auth::guard('cashier')->user()->id_number }}</strong></p>
                    <p>Mobile Number: <strong>{{ Auth::guard('cashier')->user()->mobile_number }}</strong></p>
                    <p><a href="{{ route('cashier.profile.update') }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Update Profile</a></p>
                </div>
                <div class="card-footer"> <small>Cashier Profile</small> </div>
            </div>
        </div>

    </div>
</section>

@endsection