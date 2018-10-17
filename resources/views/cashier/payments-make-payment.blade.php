@extends('layouts.app')

@section('title') Make Payment @endsection

@section('headside')
    @include('cashier.includes.header')
    @include('cashier.includes.side-menu')
@endsection


@section('content')
<p><strong>Make Payment</strong></p>
@include('includes.all')

<p>Student: <strong>{{ ucwords($student->firstname . ' ' . $student->lastname) . ' - ' . $student->student_number }}</strong></p>
<p>Balance: <strong>&#8369; {{ $student->balance->balance }}</strong></p>

@if($student->balance->balance  <= 0)
    <p><i>Student has no balance.</i></p>
@else
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('cashier.make.payment.post') }}" method="POST" autocomplete="off">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $student->id }}">
                <div class="form-group">
                    <label>Enter Amount</label>
                    <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter Amount" max="{{ $student->balance->balance }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Make Payment</button>
                </div>
            </form>            
        </div>
    </div>

@endif

@endsection