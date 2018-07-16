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
            <p><a href="{{ route('faculty.view.program.assignments') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Programs Assigned</a></p>
        	<p><strong>{{ $sem->name }} - {{ $ay->from . '-' . $ay->to }}</strong></p>
        	<p>
            @include('includes.all')
        	</p>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Students in {{ $program->code }} - {{ $program->description }} </p>
                    </div>
                </div>
                <div class="card-block">
					@if(count($students) > 0)
						<table class="table">
							<thead>
								<tr>
									<th>Name</th>
									<th>Student Number</th>
                                    <th>Remarks</th>
                                    <th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($students as $s)
									<tr>
										<td>{{ ucwords($s->lastname . ', ' . $s->firstname) }}</td>
										<td>{{ $s->student_number }}</td>
                                        <td>
                                            @foreach($remarks as $r)
                                                @if($r->student_id == $s->id)
                                                    @if($r->remarks == 1)
                                                    Competent
                                                    @else
                                                    Not Competent
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('faculty.update.progra.student.remarks', ['id' => $program->id, 'sid' => $s->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                        </td>
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