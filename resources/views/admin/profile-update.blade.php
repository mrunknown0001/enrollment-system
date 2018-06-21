@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection

@section('content')

<section class="section">
    <div class="row">

        <div class="col-xl-6">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Admin Profile Update </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')
                    <form id="signup-form" action="{{ route('admin.profile.update.post') }}" method="POST" role="form" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control underlined" name="firstname" id="firstname" value="{{ Auth::guard('admin')->user()->firstname }}" placeholder="Enter firstname" required=""> </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control underlined" name="lastname" id="lastname" value="{{ Auth::guard('admin')->user()->lastname }}" placeholder="Enter lastname" required=""> </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="id_number" id="id_number" class="form-control underlined" value="{{ Auth::guard('admin')->user()->id_number }}" placeholder="Enter ID Number" required="">
                        </div>
                        <div class="form-group">
                            <input type="text" name="mobile_number" id="mobile_number" class="form-control underlined" value="{{ Auth::guard('admin')->user()->mobile_number }}" placeholder="Enter Mobile Number" required="">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer"> <small>Admin Profile Update</small> </div>
            </div>
        </div>

    </div>
</section>

@endsection