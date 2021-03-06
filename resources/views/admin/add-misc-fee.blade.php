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
            <p><a href="{{ route('admin.rate.fee.settings') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Rate and Fees</a></p>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Add Miscellaneous Fee </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')

                    <form id="signup-form" action="{{ route('admin.add.misc.fee.post') }}" method="POST" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Miscellaneous Fee Name</label>
                            <input type="text" name="name" id="name" class="form-control underlined" placeholder="Enter Name" required="">
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount in &#8369;</label>
                            <input type="number" name="amount" id="amount" class="form-control underlined" placeholder="Enter Amount in &#8369;" required="">
                        </div>
                        <div class="form-group">
                            <label for="type">Select Payees</label>
                            <select name="type" id="type" class="form-control underlined" required="">
                                <option value="">Please Select One</option>
                                <option value="1">Miscellaneous For Courses</option>
                                <option value="2">Miscellaneous For Programs</option>
                                <option value="3">Miscellaneous For All</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Miscellaneous Fee</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection