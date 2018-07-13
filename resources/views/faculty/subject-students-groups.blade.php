@extends('layouts.app')

@section('title') Faculty @endsection

@section('headside')
    @include('faculty.includes.header')
    @include('faculty.includes.side-menu')
@endsection


@section('content')
<section class="section">
    <div class="row">

        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Groups in {{ $subject->code }} - {{ $subject->description }} </p>
                    </div>
                </div>
                <div class="card-block">
                	{{--
					@if(count($students) > 0)
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Name</th>
									<th>Student Number</th>
								</tr>
							</thead>
							<tbody>
								@foreach($students as $s)
									<tr>
										<td>{{ ucwords($s->lastname . ', ' . $s->firstname) }}</td>
										<td>{{ $s->student_number }}</td>
									</tr>
								@endforeach
							</tbody>
							<tfoot></tfoot>
						</table>
					@else
						<p>No Students Enrolled</p>
					@endif
					--}}
					
		        	@if(count($gn) > 0)
						@foreach($gn as $g)
							<a href="#" class="btn btn-primary">Students Group {{ $g->group_number }}</a>
						@endforeach
		        	@endif
                </div>
                <div class="card-footer"> <small>Students in {{ $subject->code }} - {{ $subject->description }}</small> </div>
            </div>
        </div>

    </div>
</section>
@endsection