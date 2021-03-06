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
            <p><a href="{{ route('admin.view.programs') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Programs</a></p>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Update Program </p>
                    </div>
                </div>
                
                <div class="card-block">
                    @include('includes.all')
                    <form id="signup-form" action="{{ route('admin.update.program.post') }}" method="POST" role="form" autocomplete="off">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $program->id }}"> 
                        <div class="form-group">
                            <label for="title">Program Title</label>
                            <input type="text" name="title" id="title" value="{{ $program->title }}" class="form-control underlined" placeholder="Program Title" required="">
                        </div>
                        <div class="form-group">
                            <label for="code">Program Code</label>
                            <input type="text" name="code" id="code" value="{{ $program->code }}" class="form-control underlined" placeholder="Program Code" required="">
                        </div>
                        <div class="form-group">
                            <label for="description">Program Description</label>
                            <textarea name="description" id="description" class="form-control underlined" placeholder="Program Description">{{ $program->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>From</label>
                                    <input type="date" name="from" id="from" class="form-control underlined" placeholder="mm/dd/yyyy">
                                </div>
                                <div class="col-md-6">
                                    <label>To</label>
                                    <input type="date" name="to" id="to" class="form-control underlined" placeholder="mm/dd/yyyy">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Number of Hours</label>
                            <input type="number" name="hours" id="hourse" class="form-control underlined" value="{{ $program->hours }}" placeholder="Number of Hours">
                        </div>
                        <div class="form-group">
                            <label for="tuition_fee">Tuition Fee in &#8369;</label>
                            <input type="number" name="tuition_fee" id="tuition_fee" value="{{ $program->tuition_fee }}" class="form-control underlined" placeholder="Tuition Fee in &#8369;" required="">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update Program</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection