@extends('layouts.app')

@section('title') Cashier @endsection

@section('headside')
    @include('cashier.includes.header')
    @include('cashier.includes.side-menu')
@endsection


@section('content')
<p><strong>Cashier Dashbaord</strong></p>
@include('includes.all')

@endsection