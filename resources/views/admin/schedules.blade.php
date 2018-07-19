@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Schedules</strong></p>
<p><a href="{{ route('admin.add.schedule') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Schedule</a></p>
@include('includes.all')
@if(count($schedules) > 0)
<table class="table table-bordered">

</table>
@else
<p class="text-center">No Schedules Available!</p>
@endif
@endsection