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

                    @if(count($sem) > 0)
                    <p>Semester: <strong>{{ ucwords($sem->name) }}</strong></p>
                    @if($sem->id == 2)
                    <p><a href="{{ route('admin.set.semester', ['id' => $sem->id - 1]) }}" class="btn btn-primary">Set Previous Semester</a></p>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#confirm">Close Academic Year</button>

                    @else
                    <a href="{{ route('admin.set.semester', ['id' => $sem->id + 1]) }}" class="btn btn-primary">Set Next Semester</a>
                    @endif
                    @else
                    <form action="{{ route('admin.set.semester.post') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="radio" name="semester" id="first_semester" value="1" required="">
                                    <label for="first_semester">First Semester</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" name="semester" id="second_semester" value="2">
                                    <label for="second_semester">Second Semester</label>   
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Set Semester</button>
                        </div>
                    </form>
                    @endif
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
                                    <form action="{{ route('admin.close.academic.year.post') }}" method="POST">
                                        {{ csrf_field() }}
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

            @if(count($ays) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Past AY</th>
                        <th>From</th>
                        <th>To</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ays as $y)
                    <tr>
                        <td></td>
                        <td>{{ $y->from }}</td>
                        <td>{{ $y->to }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot></tfoot>
            </table>
            @endif
        </div>
    </div>
</section>

@endsection