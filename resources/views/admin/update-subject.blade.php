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
                        <p class="title"> Update Subject </p>
                    </div>
                </div>
                
                <div class="card-block">
                    @include('includes.all')
                    <form id="signup-form" action="{{ route('admin.update.subject.post') }}" method="POST" role="form" autocomplete="off">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $subject->id }}">
                        <div class="form-group">
                            <input type="text" name="code" id="code" class="form-control underlined" value="{{ $subject->code }}" placeholder="Subject Code" required="">
                        </div>
                        <div class="form-group">
                            <textarea name="description" id="description" class="form-control underlined" placeholder="Subject Description">{{ $subject->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <input type="number" name="units" id="units" class="form-control underlined" value="{{ $subject->units }}" placeholder="Number of Units" required="">
                        </div>
                        <div class="form-group">
                            <input type="number" name="hours" id="hours" class="form-control underlined" value="{{ $subject->hours }}" placeholder="Hours per class" required="">
                        </div>
                        <div class="form-group">
                            <select name="year_level" id="year_level" class="form-control underlined" required="">
                                <option value="">Select Year Level</option>
                                @foreach($yl as $y)
                                <option value="{{ $y->id }}" {{ $y->id == $subject->year_level ? 'selected' : '' }}>{{ ucwords($y->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update Subject</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection