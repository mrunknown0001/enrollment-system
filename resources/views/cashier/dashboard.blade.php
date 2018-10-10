@extends('layouts.app')

@section('title') Cashier @endsection

@section('headside')
    @include('cashier.includes.header')
    @include('cashier.includes.side-menu')
@endsection


@section('content')
<p><strong>Cashier Dashboard</strong></p>
@include('includes.all')
            @if(count($logs) > 0)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Action</th>
                        <th class="text-center">Date &amp; Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td class="text-center">
                            {{ $log->action }}
                        </td>
                        <td class="text-center">
                            {{ date('l, F j, Y g:i:s a', strtotime($log->created_at)) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    
                </tfoot>
            </table>
            <div class="text-center"> {{ $logs->links() }}</div>
            @else
            <p class="text-center"><em>No activity logs</em></p>
            @endif
@endsection