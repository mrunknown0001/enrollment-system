@extends('layouts.app')

@section('title') Registrar @endsection

@section('headside')
    @include('registrar.includes.header')
    @include('registrar.includes.side-menu')
@endsection


@section('content')
@include('includes.all')
<section class="section">
    <div class="row">
        <div class="col-xl-12">
            <p><a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a></p>
            <p><strong>{{ $sem->name }} - {{ $ay->from . '-' . $ay->to }}</strong></p>
            <p>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Student Remark Update {{ $program->code }} </p>
                    </div>
                </div>
                <div class="card-block">
                    <p>Name: {{ ucwords($student->firstname . ' ' . $student->lastname) }}</p>
                    <form action="{{ route('registrar.update.student.program.remarks.post') }}" method="POST" role="form">
                        {{ csrf_field() }}
                        <input type="hidden" name="program_id" value="{{ $program->id }}">
                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                        <div class="form-group">
                            <select name="remark" class="form-control underlined">
                                <option value="">Select Remark</option>
                                <option value="1">Competent</option>
                                <option value="0">Not Competent</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update Remark</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer"> <small>Program Remark Update</small> </div>
            </div>
        </div>

    </div>
</section>

@endsection