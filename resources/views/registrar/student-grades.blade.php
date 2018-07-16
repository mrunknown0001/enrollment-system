@extends('layouts.app')

@section('title') Registrar @endsection

@section('headside')
    @include('registrar.includes.header')
    @include('registrar.includes.side-menu')
@endsection


@section('content')
<section class="section">
    <div class="row">
        <div class="col-md-8">
            <p><a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a></p>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Student Grades </p>
                    </div>
                </div>
                <div class="card-block">
                	@include('includes.all')
					<p>Enrolled in {{ $course->title }}</p>
					<p>{{ ucwords($student->firstname . ' ' . $student->lastname) }} - {{ $student->student_number }}</p>
					
                    @if(count($grades) > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Prelim</th>
                                <th>Midterm</th>
                                <th>Semi-Final</th>
                                <th>Final</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subjects as $sub)
                                <tr>
                                    <td>{{ $sub->code }}</td>
                                    @foreach($grades as $gr)
                                        @foreach($gr as $g)
                                            @if($g->term_id == 1)
                                                <td>{{ $g->grade }}</td>
                                            @endif
                                            @if($g->term_id == 2)
                                                <td>{{ $g->grade }}</td>
                                            @endif
                                            @if($g->term_id == 3)
                                                <td>{{ $g->grade }}</td>
                                            @endif
                                            @if($g->term_id == 4)
                                                <td>{{ $g->grade }}</td>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                    @else
                    <p>No Grades Yet</p>
                    @endif
                </div>
                <div class="card-footer"> <small> Student Grades </small> </div>
            </div>
        </div>
    </div>
</section>
@endsection