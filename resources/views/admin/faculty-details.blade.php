@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<section class="section">
    <div class="row">
        <div class="col-md-8">
            <p><a href="{{ route('admin.view.faculties') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Faculties</a></p>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Faculty Details</p>
                    </div>
                </div>
                <div class="card-block">
                    <p>Name: <strong>{{ ucwords($faculty->firstname . ' ' . $faculty->lastname) }}</strong></p>
                    <p>ID Number: <strong>{{ $faculty->id_number }}</strong></p>
                    <p>Mobile Number: <strong>{{ $faculty->mobile_number }}</strong></p>
                    <p>Date of Birth: <strong>{{ date('F d,Y', strtotime($faculty->info->date_of_birth)) }}</strong></p>
                    <p>Place of Birth: <strong>{{ ucwords($faculty->info->place_of_birth) }}</strong></p>
                    <p>Address: <strong>{{ ucwords($faculty->info->address) }}</strong></p>
                    <p>Nationality: <strong>{{ ucwords($faculty->info->nationality) }}</strong></p>
                    <p>Subjects Assigned: <strong>
                        @if(count($subjects) > 0)
                            <ul>
                                @foreach($subjects as $s)
                                    <li>{{ $s->code }} - {{ $s->description }}</li>
                                @endforeach
                            </ul>
                        @else
                            No Assigned Subject
                        @endif
                    </strong></p>
                    <p>Program Assigned: <strong>
                        @if(count($programs) > 0)
                            <ul>
                                @foreach($programs as $p)
                                    <li>{{ $p->title }} - {{ $p->description }}</li>
                                @endforeach
                            </ul>
                        @else
                            No Assigned Program
                        @endif
                    </strong></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection