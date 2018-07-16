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
            <p><a href="{{ route('admin.subjects') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Subjects</a></p>
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
                            <label for="code">Subject Code</label>
                            <input type="text" name="code" id="code" class="form-control underlined" placeholder="Subject Code" required="">
                        </div>
                        <div class="form-group">
                            <label for="description">Subject Description</label>
                            <textarea name="description" id="description" class="form-control underlined" placeholder="Subject Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="units">Subject Number of Units</label>
                            <input type="number" name="units" id="units" class="form-control underlined" placeholder="Number of Units" required="">
                        </div>
                        <div class="form-group">
                            <label for="hours">Subject Number of Hours</label>
                            <input type="number" name="hours" id="hours" class="form-control underlined" placeholder="Hours per Class" required="">
                        </div>
                        <div class="form-group">
                            <label for="prerequisite">Subject Prerequisite</label>
                            <select name="prerequisite" id="prerequisite" class="form-control underlined">
                                <option value="">No Prerequisite</option>
                                @if(count($subjects) > 0)
                                @foreach($subjects as $s)
                                <option value="{{ $s->id }}">{{ $s->code }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>                        
                        <div class="form-group">
                            <label for="year_level">Subject Year Level</label>
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