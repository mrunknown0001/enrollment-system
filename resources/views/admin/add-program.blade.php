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
                    <h3 class="title"> Add Program </h3>
                </div>
                
                @include('includes.all')

                <form id="signup-form" action="{{ route('admin.add.registrar.post') }}" method="POST" role="form" autocomplete="off">
                    {{ csrf_field() }}
                    
                    <div class="form-group">
                        <button class="btn btn-primary"><i class="fa fa-plus"></i> Add Program</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection