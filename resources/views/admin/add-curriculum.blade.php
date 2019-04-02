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
            <p><a href="" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Curiculum</a></p>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Add Curiculum </p>
                    </div>
                </div>
                
                <div class="card-block">
                    @include('includes.all')
                    <form id="signup-form" action="" method="POST" role="form" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Curriculum Name</label>
                            <input type="text" name="name" id="name" class="form-control underlined" placeholder="Curriculum" required="">
                        </div>
                        <div class="form-group">
                            <label for="description">Course Description</label>
                            <textarea name="description" id="description" class="form-control underlined" placeholder="Course Description"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary"><i class="fa fa-plus"></i> Add Course</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection