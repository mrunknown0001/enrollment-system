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
            <div class="card card-block">
                <div class="title-block">
                    <h3 class="title"> Add Program </h3>
                </div>
                
                @include('includes.all')

                <form id="signup-form" action="{{ route('admin.add.program.post') }}" method="POST" role="form" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" name="title" id="title" class="form-control underlined" placeholder="Program Title" required="">
                    </div>
                    <div class="form-group">
                        <input type="text" name="code" id="code" class="form-control underlined" placeholder="Program Code" required="">
                    </div>
                    <div class="form-group">
                        <textarea name="description" id="description" class="form-control underlined" placeholder="Program Description"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="number" name="tuition_fee" id="tuition_fee" class="form-control underlined" placeholder="Tuition Fee" required="">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary"><i class="fa fa-plus"></i> Add Program</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection