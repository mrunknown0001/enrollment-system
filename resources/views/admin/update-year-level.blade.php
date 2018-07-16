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
            <p><a href="{{ route('admin.view.year.level') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Year Levels</a></p>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Update Year Level </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')
                    <form id="signup-form" action="{{ route('admin.update.year.level.post') }}" method="POST" role="form" autocomplete="off">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $yl->id }}">
                        <div class="form-group">
                            <label for="name">Year Level Name</label>
                            <input type="text" name="name" id="name" class="form-control underlined" value="{{ $yl->name }}" placeholder="Year Level Name" required="">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control underlined" placeholder="Program Description">{{ $yl->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update Year Level</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection