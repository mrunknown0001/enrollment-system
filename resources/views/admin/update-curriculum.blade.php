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
            <p><a href="{{ route('admin.view.curriculum') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Curiculum</a></p>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Update Curiculum </p>
                    </div>
                </div>
                
                <div class="card-block">
                    @include('includes.all')
                    <form id="signup-form" action="{{ route('admin.update.curriculum.post') }}" method="POST" role="form" autocomplete="off">
                        {{ csrf_field() }}
                        <input type="hidden" name="curriculum_id" value="{{ $curriculum->id }}">
                        <div class="form-group">
                            <label for="title">Curriculum Name</label>
                            <input type="text" name="name" id="name" class="form-control underlined" value="{{ $curriculum->name }}" placeholder="Curriculum" required="">
                        </div>
                        <div class="form-group">
                            <label for="description">Curiculum Description</label>
                            <textarea name="description" id="description" class="form-control underlined" placeholder="Curiculum Description">{{ $curriculum->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary"><i class="fa fa-plus"></i> Update Curiculum</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection