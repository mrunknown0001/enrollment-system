@extends('layouts.app')

@section('title') Cashier @endsection

@section('headside')
    @include('registrar.includes.header')
    @include('registrar.includes.side-menu')
@endsection


@section('content')
<p><strong>Registrar Dashbaord</strong></p>
@include('includes.all')

@endsection