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
                        <p class="title"> Update Load of {{ ucwords($faculty->firstname . ' ' . $faculty->lastname) }} - {{ $faculty->id_number }} </p>
                    </div>
                </div>
                <div class="card-block">
                    @include('includes.all')
					
                    @if(count($subjects_assigned) > 0)
                    <p><a href="{{ route('admin.update.faculty.load.subjects', ['id' => $faculty->id]) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Update Subjects Assigned</a></p>
                    @endif
                    
                    @if(count($programs_assigned) > 0)
                    <p><a href="{{ route('admin.update.faculty.load.programs', ['id' => $faculty->id]) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Update Programs Assigned</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection