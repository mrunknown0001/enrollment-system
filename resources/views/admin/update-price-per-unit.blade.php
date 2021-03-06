@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection

@section('content')

<section class="section">
    <div class="row">
        <div class="col-md-12">
            <p><a href="{{ route('admin.rate.fee.settings') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Rate and Fees</a></p>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Update Price Per Unit </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')
                    <p>Current Price per Unit: <strong>&#8369; {{ $price->price }}</strong></p>
                    <div class="row">
                        <div class="col-md-5">
                            <form id="signup-form" action="{{ route('admin.price.per.unit.update.post') }}" method="POST" role="form" autocomplete="off">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>&#8369;rice Per Unit</label>
                                    <input type="number" name="price" id="price" class="form-control underlined" placeholder="00.00" required="">
                                </div>
                                <div class="from-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update Price</button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>

@endsection