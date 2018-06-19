@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Activity Logs</strong></p>
@include('includes.all')

<section class="section">
    <div class="row">
        <div class="col-md-12">
            @if(count($logs) > 0)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Action</th>
                        <th>Date &amp; Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td>
                            @if($log->user_type == 1)
                            {{ $log->admin->firstname . ' ' . $log->admin->lastname }}
                            @elseif($log->user_type == 2)
                            {{ $log->registrar->firstname . ' ' . $log->registrar->lastname }}
                            @elseif($log->user_type == 3)
                            {{ $log->cashier->firstname . ' ' . $log->cashier->lastname }}
                            @elseif($log->user_type == 4)
                            {{ $log->faculty->firstname . ' ' . $log->faculty->lastname }}
                            @elseif($log->user_type == 5)
                            {{ $log->student->firstname . ' ' . $log->student->lastname }}
                            @else
                            N/A
                            @endif
                        </td>
                        <td>
                            @if($log->user_type == 1)
                            Administrator
                            @elseif($log->user_type == 2)
                            Registrar
                            @elseif($log->user_type == 3)
                            Cashier
                            @elseif($log->user_type == 4)
                            Faculty
                            @elseif($log->user_type == 5)
                            Student
                            @else
                            N/A
                            @endif
                        </td>
                        <td>
                            {{ $log->action }}
                        </td>
                        <td>
                            {{ date('l, F j, Y g:i:s a', strtotime($log->created_at)) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    
                </tfoot>
            </table>
            @else
            <p class="text-center"><em>No activity logs</em></p>
            @endif
        </div>
    </div>
</section>

@endsection