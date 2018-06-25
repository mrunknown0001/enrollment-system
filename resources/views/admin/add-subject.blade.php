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
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Add Subject </p>
                    </div>
                </div>
                
                <div class="card-block">
                    @include('includes.all')
                    <form id="signup-form" action="{{ route('admin.add.subject.post') }}" method="POST" role="form" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="code" id="code" class="form-control underlined" placeholder="Subject Code" required="">
                        </div>
                        <div class="form-group">
                            <textarea name="description" id="description" class="form-control underlined" placeholder="Subject Description"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="number" name="units" id="units" class="form-control underlined" placeholder="Number of Units" required="">
                        </div>
                        <div class="form-group">
                            <input type="number" name="hours" id="hours" class="form-control underlined" placeholder="Hours per Class" required="">
                        </div>
                        <div class="form-group">
                            <select name="year_level" id="year_level" class="form-control underlined" required="">
                                <option value="">Select Year Level</option>
                                @foreach($yl as $y)
                                <option value="{{ $y->id }}">{{ ucwords($y->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary"><i class="fa fa-plus"></i> Add Subject</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection