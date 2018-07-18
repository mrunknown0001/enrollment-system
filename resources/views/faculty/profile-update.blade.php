@extends('layouts.app')

@section('title') Faculty @endsection

@section('headside')
    @include('faculty.includes.header')
    @include('faculty.includes.side-menu')
@endsection

@section('content')

<section class="section">
    <div class="row">

        <div class="col-xl-12">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Faculty Profile Update </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')
                    <form id="signup-form" action="{{ route('faculty.profile.update.post') }}" method="POST" role="form" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" class="form-control underlined" name="firstname" id="firstname" value="{{ Auth::guard('faculty')->user()->firstname }}" placeholder="Enter firstname" required=""> </div>
                                <div class="col-sm-6">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" class="form-control underlined" name="lastname" id="lastname" value="{{ Auth::guard('faculty')->user()->lastname }}" placeholder="Enter lastname" required=""> </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="id_number">ID Number</label>
                            <input type="text" name="id_number" id="id_number" class="form-control underlined" value="{{ Auth::guard('faculty')->user()->id_number }}" placeholder="Enter ID Number" required="">
                        </div>
                        <div class="form-group">
                            <label for="mobile_number">Mobile Number</label>
                            <input type="text" name="mobile_number" id="mobile_number" class="form-control underlined" value="{{ Auth::guard('faculty')->user()->mobile_number }}" placeholder="Enter Mobile Number" required="">
                        </div>

                        <div class="form-group">
                            <label for="date_of_birth">Date of Birth</label>
                            <input type="text" class="form-control underlined" name="date_of_birth" id="date_of_birth" value="{{ date('m', strtotime(Auth::guard('faculty')->user()->info->date_of_birth))}}/{{date('d', strtotime(Auth::guard('faculty')->user()->info->date_of_birth))}}/{{date('Y', strtotime(Auth::guard('faculty')->user()->info->date_of_birth)) }}" placeholder="mm/dd/yyyy" required=""> </div>

                        <div class="form-group">
                            <label for="place_of_birth">Place of Birth</label>
                            <input type="text" class="form-control underlined" name="place_of_birth" id="place_of_birth" placeholder="Enter place of birth" required=""> </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control underlined" name="address" id="address" required="" placeholder="Enter address"></textarea> </div>

                        <div class="form-group">
                            <label for="nationality">Nationality</label>
                            <input type="text" class="form-control underlined" name="nationality" id="nationality" placeholder="Enter nationality" required=""> </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update Profile</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer"> <small>Faculty Profile Update</small> </div>
            </div>
        </div>

    </div>
</section>

@endsection