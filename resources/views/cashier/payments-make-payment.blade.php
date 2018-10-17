@extends('layouts.app')

@section('title') Make Payment @endsection

@section('headside')
    @include('cashier.includes.header')
    @include('cashier.includes.side-menu')
@endsection


@section('content')
<p><strong>Make Payment</strong></p>
@include('includes.all')



@endsection