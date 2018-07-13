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
        	<p><strong>{{ $sem->name }} - {{ $ay->from . '-' . $ay->to }}</strong></p>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Students in {{ $subject->code }} - {{ $subject->description }} </p>
                    </div>
                </div>
                <div class="card-block">
					@if(count($students) > 0)
						<form action="{{ route('faculty.encode.subject.students.grade.post') }}" method="POST">
							{{ csrf_field() }}
							<input type="hidden" name="subject_id" value="{{ $subject->id }}">
							<input type="hidden" name="semester_id" value="{{ $sem->id }}">
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
								</tr>
							</thead>
							<tbody>
								@foreach($students as $s)
									<tr>
										<td>{{ ucwords($s->lastname . ', ' . $s->firstname) }} -
											{{ $s->student_number }}
										</td>
										<td>
											<input type="number" name="{{ $s->student_number }}[1]" class="form-control underlined">
										</td>
										<td>
											<input type="number" name="{{ $s->student_number }}[2]" class="form-control underlined">
										</td>
										<td>
											<input type="number" name="{{ $s->student_number }}[3]" class="form-control underlined">
										</td>
										<td>
											<input type="number" name="{{ $s->student_number }}[4]" class="form-control underlined">
										</td>
									</tr>
								@endforeach
							</tbody>
							<tfoot></tfoot>
						</table>

						<button type="submit" class="btn btn-primary">Save Grades</button>
					</form>
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