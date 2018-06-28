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
                        <p class="title"> Academic Year </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')
                    @if(count($ay) > 0)
                    <p>Academic Year: <strong>{{ $ay->from . '-' . $ay->to }}</strong></p>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#confirm">Close Academic Year</button>
                    @else
                    <a href="{{ route('admin.add.academic.year') }}" class="btn btn-primary">Add Academic Year</a>
                    @endif
                    <div class="modal fade" id="confirm">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">
                                        <i class="fa fa-info"></i> Confirm Closing of Academic Year</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="#" method="POST">
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" class="form-control underlined" placeholder="Enter Password to Confirm" required="" />
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger">Continue...</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <small>Academic Year</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection