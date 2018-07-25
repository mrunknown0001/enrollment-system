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
                	<p><button type="button" onclick="window.print()" class="btn btn-primary"><i class="fa fa-print"></i> Print</button></p>
                	@include('includes.all')
					<div id="printableArea">
						<h3 class="text-center showOnPrint">Internation Computer Technology Colleges</h3>
						<p class="text-center showOnPrint">Your Gateway to a Global Job Opportunity</p>
						<p class="text-center showOnPrint">2<sup>nd</sup> of AA building, Barangay Sto Cristo, Tarlac City</p>
						<p class="text-center showOnPrint"><strong>{{ $sem->name }} - {{ $ay->from . '-' . $ay->to }}</strong></p>
						<p class="text-center showOnPrint">{{ $subject->code }} - {{ $subject->description }} </p>
						@if(count($students) > 0)
							<div class="gradePrint">
								<table class="table table-bordered table-hover">
									<thead>
										<tr class="text-center">
											<th>Students</th>
											<th>Prelim</th>
											<th>Midterm</th>
											<th>Semi Final</th>
											<th>Final</th>
											<th id="displayNoneOnPrint"></th>
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
																<td class="text-center">{{ $g->grade }}</td>
															@endif
															@if($g->term_id == 2)
																<td class="text-center">{{ $g->grade }}</td>
															@endif
															@if($g->term_id == 3)
																<td class="text-center">{{ $g->grade }}</td>
															@endif
															@if($g->term_id == 4)
																<td class="text-center">{{ $g->grade }}</td>
															@endif
														@endif
													@endforeach
												@endforeach
												<td id="displayNoneOnPrint">
													<a href="{{ route('faculty.update.subject.student.grades', ['id' => $subject->id, 'gid' => $gid, 'sid' => $s->id]) }}" class="btn btn-primary btn-sx"><i class="fa fa-pencil"></i> Edit</a>
												</td>
											</tr>
										@endforeach
									</tbody>
									<tfoot></tfoot>
								</table>
							</div>
						@else
							<p>No Students Enrolled</p>
						@endif
					</div>
                </div>
                <div class="card-footer"> <small>Students in {{ $subject->code }} - {{ $subject->description }}</small> </div>
            </div>
        </div>

    </div>
</section>
@endsection