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
                        <p class="title"> Subject: {{ $subject->code }} - Group Manager </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')
                    
                    @if(count($gn) > 1)
                    <form action="{{ route('admin.manage.subject.students.group.post') }}" method="POST" role="form">
                        {{ csrf_field() }}
                        <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                        @foreach($gn as $g)
                        <div class="form-group">
                            @if($g->group_number == 1)
                                <lable>
                                    <input type="checkbox" name="group[]" value="1">
                                    Group Number 1: {{ count($students_group1) }} students
                                </lable>
                            @endif

                            @if($g->group_number == 2)
                                <lable>
                                    <input type="checkbox" name="group[]" value="2">
                                    Group Number 2: {{ count($students_group2) }} students
                                </lable>
                            @endif

                            @if($g->group_number == 3)
                                <lable>
                                    <input type="checkbox" name="group[]" value="3">
                                    Group Number 3: {{ count($students_group3) }} students
                                </lable>
                            @endif
                        </div>
                        @endforeach
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Merge Selected</button>
                        </div>
                    </form>
                    @else 
                        <p>No Need for merge</p>
                    @endif
                </div>
                <div class="card-footer"> <small>Group Manager</small> </div>
            </div>
        </div>

    </div>
</section>

@endsection