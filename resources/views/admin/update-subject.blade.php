@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')

<section class="section">
    <div class="row">
        <div class="col-md-12">
            <p><a href="{{ route('admin.subjects') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Subjects</a></p>
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
                            <label>Code</label>
                            <input type="text" name="code" id="code" class="form-control underlined" value="{{ $subject->code }}" placeholder="Subject Code" required="">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="description" class="form-control underlined" placeholder="Subject Description">{{ $subject->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Number of Units</label>
                            <input type="number" name="units" id="units" class="form-control underlined" value="{{ $subject->units }}" placeholder="Number of Units" required="">
                        </div>
                        <div class="form-group">
                            <label>Number of Hours</label>
                            <input type="number" name="hours" id="hours" class="form-control underlined" value="{{ $subject->hours }}" placeholder="Hours per class" required="">
                        </div>
                        <div class="form-group">
                            <label>Prerequisite</label>
                            <select name="prerequisite" id="prerequisite" class="form-control underlined">
                                <option value="">No Prerequisite</option>
                                @if(count($subjects) > 0)
                                    @foreach($subjects as $s)
                                        @if($s->id != $subject->id)
                                            <option value="{{ $s->id }}" @if(count($subject->prereq) > 0) {{ $subject->prereq->id == $s->id ? 'selected' : '' }} @endif>{{ $s->code }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>  
                        <div class="form-group">
                            <label for="year_level">Select Year Level</label>
                            <select name="year_level" id="year_level" class="form-control underlined" required="">
                                <option value="">Select Year Level</option>
                                @foreach($yl as $y)
                                <option value="{{ $y->id }}" {{ $y->id == $subject->year_level ? 'selected' : '' }}>{{ ucwords($y->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="semester">Subject Semester</label>
                            <select name="semester" id="semester" class="form-control underlined" required="">
                                <option value="">Select Semester</option>
                                <option value="1" {{ $subject->semester == 1 ? 'selected' : '' }}>First Semester</option>
                                <option value="2" {{ $subject->semester == 2 ? 'selected' : '' }}>Second Semester</option>
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