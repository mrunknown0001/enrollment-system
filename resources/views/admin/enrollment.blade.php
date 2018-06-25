@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Enrollment</strong></p>
@include('includes.all')

<section class="section">
    <div class="row">
        <div class="col-md-12">

        </div>
    </div>
</section>
@endsection