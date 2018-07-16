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
            <p><a href="{{ route('admin.view.faculties') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Faculties</a></p>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> {{ ucwords($faculty->firstname . ' ' . $faculty->lastname) }} - {{ $faculty->id_number }} </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')
                    @if(count($faculty->subject_assignments) > 0)
                    <p>Update Subjects Only</p>
                    @else
					<p><a href="{{ route('admin.add.subject.load.faculty', ['id' => $faculty->id]) }}" class="btn btn-primary">Assign Subjects</a></p>
                    @endif
                    @if(count($faculty->program_assignments) > 0)
                    <p>Update Programs Only</p>
                    @else
					<p><a href="{{ route('admin.add.program.load.faculty', ['id' => $faculty->id]) }}" class="btn btn-primary">Assign Program</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection