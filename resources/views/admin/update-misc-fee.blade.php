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
                        <p class="title"> Update Miscellaneous Fee </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')

                    <form id="signup-form" action="{{ route('admin.update.misc.fee.post') }}" method="POST" autocomplete="off">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $misc->id }}">
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control underlined" value="{{ $misc->name }}" placeholder="Enter Name" required="">
                        </div>
                        <div class="form-group">
                            <input type="number" name="amount" id="amount" class="form-control underlined" value="{{ $misc->amount }}" placeholder="Enter Amount" required="">
                        </div>
                        <div class="form-group">
                            <select name="type" id="type" class="form-control underlined" required="">
                                <option value="">Please Select One</option>
                                <option value="1">Miscellaneous For Courses</option>
                                <option value="2">Miscellaneous For Programs</option>
                                <option value="3">Miscellaneous For All</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update Miscellaneous Fee</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection