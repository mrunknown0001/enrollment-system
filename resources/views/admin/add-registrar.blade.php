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
            <div class="card card-block">
                <div class="title-block">
                    <h3 class="title"> Add Registrar </h3>
                </div>
                
                @include('includes.all')

                <form id="signup-form" action="#" method="POST" role="form" autocomplete="off">
                	{{ csrf_field() }}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control underlined" name="firstname" id="firstname" placeholder="Enter firstname" required=""> </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control underlined" name="lastname" id="lastname" placeholder="Enter lastname" required=""> </div>
                        </div>    
                    </div>
                    <div class="form-group">
                        <input type="text" name="username" id="username" class="form-control underlined" placeholder="Enter username"> </div>
                    <div class="form-group">
                        <input type="text" name="id_number" id="id_number" class="form-control underlined" placeholder="Enter ID Number"> </div>
                    <div class="form-group">
                        <input type="text" name="mobile_number" id="mobile_number" class="form-control underlined" placeholder="Enter mobile number"> </div>
                    <div class="form-group">
                    	<button class="btn btn-primary"><i class="fa fa-plus"></i> Add Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection