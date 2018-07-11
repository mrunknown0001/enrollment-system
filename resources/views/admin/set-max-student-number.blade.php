@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')

<section class="section">
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Set Max Number of Students per Subject Class </p>
                    </div>
                </div>
                
                <div class="card-block">
                    @include('includes.all')
                    <form id="signup-form" action="{{ route('admin.set.max.student.number.post') }}" method="POST" role="form" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="number" name="limit" id="limit" class="form-control underlined" placeholder="Set Max Number of Students" required="">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary"><i class="fa fa-floppy-o"></i> Set Number</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection