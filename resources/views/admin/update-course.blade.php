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
                        <p class="title"> Update Course </p>
                    </div>
                </div>
                
                <div class="card-block">
                    @include('includes.all')
                    <form id="signup-form" action="#" method="POST" role="form" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="title" id="title" class="form-control underlined" value="{{ $course->title }}" placeholder="Course Title" required="">
                        </div>
                        <div class="form-group">
                            <input type="text" name="code" id="code" class="form-control underlined" value="{{ $course->code }}" placeholder="Course Code" required="">
                        </div>
                        <div class="form-group">
                            <textarea name="description" id="description" class="form-control underlined" placeholder="Course Description">{{ $course->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary"><i class="fa fa-plus"></i> Update Course</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection