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
                        <p class="title"> Admin Change Password </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')
                    <form id="signup-form" action="{{ route('admin.change.password.post') }}" method="POST" role="form" autocomplete="off">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <input type="password" name="old_password" id="old_password" class="form-control underlined" placeholder="Enter Old Password" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="password" class="form-control underlined" name="password" id="password" placeholder="Enter password" required=""> </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control underlined" name="password_confirmation" id="password_confirmation" placeholder="Re-type password" required=""> </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Change Password</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer"> <small>Admin Change Password</small> </div>
            </div>
        </div>

    </div>
</section>

@endsection