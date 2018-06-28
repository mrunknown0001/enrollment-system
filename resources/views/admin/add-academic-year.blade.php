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
                        <p class="title"> Add Academic Year </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')
                    <form action="{{ route('admin.add.academic.year.post') }}" method="POST" role="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <select name="from" id="from" class="form-control underlined">
                                        <option></option>
                                        <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select name="to" id="to" class="form-control underlined">
                                        <option></option>
                                        <option value="{{ date('Y') + 1 }}">{{ date('Y') + 1 }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add Academic Year</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection