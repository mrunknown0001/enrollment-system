@extends('layouts.app')

@section('title') Faculty @endsection

@section('headside')
    @include('faculty.includes.header')
    @include('faculty.includes.side-menu')
@endsection


@section('content')
<section class="section">
    <div class="row">

        <div class="col-md-12">
        	<p><a href="{{ route('faculty.view.subject.assignments') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Subjects Assigned</a></p>
        	<p><strong>{{ $sem->name }} - {{ $ay->from . '-' . $ay->to }}</strong></p>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Students in {{ $subject->code }} - {{ $subject->description }} </p>
                    </div>
                </div>
                <div class="card-block">
                	@include('includes.all')
					@if(count($students) > 0)
						<table class="table">
							<thead>
								<tr class="text-center">
									<th rowspan="2">Students</th>
									<th colspan="4">Terms</th>
								</tr>
								<tr>
									<th>Prelim</th>
									<th>Midterm</th>
									<th>Semi Final</th>
									<th>Final</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($students as $s)
									<tr>
										<td>{{ ucwords($s->lastname . ', ' . $s->firstname) }} -
											{{ $s->student_number }}
										</td>

										@foreach($grades as $gr)
											@foreach($gr as $g)
												@if($s->id == $g->student_id)
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
												@endif
											@endforeach
										@endforeach
										<td>
											<a href="{{ route('faculty.update.subject.student.grades', ['id' => $subject->id, 'gid' => $gid, 'sid' => $s->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>
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
                <div class="card-footer"> <small>Students in {{ $subject->code }} - {{ $subject->description }}</small> </div>
            </div>
        </div>

    </div>
</section>
@endsection