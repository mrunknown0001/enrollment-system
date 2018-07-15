@extends('layouts.app')

@section('title') Faculty @endsection

@section('headside')
    @include('faculty.includes.header')
    @include('faculty.includes.side-menu')
@endsection


@section('content')
<section class="section">
    <div class="row">

        <div class="col-md-10">
        	<p><strong>{{ $sem->name }} - {{ $ay->from . '-' . $ay->to }}</strong></p>
        	<p>
        		@if(count($encode) > 0)
        		<a href="{{ route('faculty.view.program.students.remarks', ['id' => $program->id]) }}" class="btn btn-primary">View Remarks</a>
				@else
        		<a href="{{ route('faculty.encode.program.remarks', ['id' => $program->id]) }}" class="btn btn-primary">Encode Remarks</a>
        		@endif
        	</p>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Students in {{ $program->code }} - {{ $program->description }} </p>
                    </div>
                </div>
                <div class="card-block">
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
                </div>
                <div class="card-footer"> <small>Students in {{ $program->code }} - {{ $program->description }}</small> </div>
            </div>
        </div>

    </div>
</section>
@endsection