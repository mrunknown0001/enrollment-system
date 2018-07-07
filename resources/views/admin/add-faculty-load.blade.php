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
                        <p class="title"> {{ ucwords($faculty->firstname . ' ' . $faculty->lastname) }} - {{ $faculty->id_number }} </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')
					<p><a href="{{ route('admin.add.subject.load.faculty', ['id' => $faculty->id]) }}">Assign Subjects</a></p>
					<p><a href="{{ route('admin.add.program.load.faculty', ['id' => $faculty->id]) }}">Assign Program</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection