@extends('layouts.app')

@section('title') Cashier @endsection

@section('headside')
    @include('cashier.includes.header')
    @include('cashier.includes.side-menu')
@endsection

@section('content')

<section class="section">
    <div class="row">

        <div class="col-xl-12">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Cashier Profile Update </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')
                    <form id="signup-form" action="{{ route('cashier.profile.update.post') }}" method="POST" role="form" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" class="form-control underlined" name="firstname" id="firstname" value="{{ Auth::guard('cashier')->user()->firstname }}" placeholder="Enter firstname" required=""> </div>
                                <div class="col-sm-6">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" class="form-control underlined" name="lastname" id="lastname" value="{{ Auth::guard('cashier')->user()->lastname }}" placeholder="Enter lastname" required=""> </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="id_number">ID Number</label>
                            <input type="text" name="id_number" id="id_number" class="form-control underlined" value="{{ Auth::guard('cashier')->user()->id_number }}" placeholder="Enter ID Number" required="">
                        </div>
                        <div class="form-group">
                            <label for="mobile_number">Mobile Number</label>
                            <input type="text" name="mobile_number" id="mobile_number" class="form-control underlined" value="{{ Auth::guard('cashier')->user()->mobile_number }}" placeholder="Enter Mobile Number" required="">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update Profile</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer"> <small>Cashier Profile Update</small> </div>
            </div>
        </div>

    </div>
</section>

@endsection