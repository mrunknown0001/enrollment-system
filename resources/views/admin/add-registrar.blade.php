@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')

<section class="section">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Add Registrar </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')

                    <form id="signup-form" action="{{ route('admin.add.registrar.post') }}" method="POST" role="form" autocomplete="off">
                    	{{ csrf_field() }}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" class="form-control underlined" name="firstname" id="firstname" placeholder="Enter firstname" required=""> </div>
                                <div class="col-sm-6">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" class="form-control underlined" name="lastname" id="lastname" placeholder="Enter lastname" required=""> </div>
                            </div>    
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control underlined" placeholder="Enter username"> </div>
                        <div class="form-group">
                            <label for="id_number">ID Number</label>
                            <input type="text" name="id_number" id="id_number" class="form-control underlined" placeholder="Enter ID Number"> </div>
                        <div class="form-group">
                            <label for="mobile_number">Mobile Number</label>
                            <input type="text" name="mobile_number" id="mobile_number" class="form-control underlined" placeholder="Enter mobile number"> </div>
                        <div class="form-group">
                        	<button class="btn btn-primary"><i class="fa fa-plus"></i> Add Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection