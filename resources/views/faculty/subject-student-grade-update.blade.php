@extends('layouts.app')

@section('title') Faculty @endsection

@section('headside')
    @include('faculty.includes.header')
    @include('faculty.includes.side-menu')
@endsection


@section('content')
@include('includes.all')
<section class="section">
	<div class="row">
		<div class="col-md-12">
			<p><a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a></p>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> {{ ucwords($student->firstname . ' ' . $student->lastname) }} - {{ $subject->code }} Grade Update </p>
                    </div>
                </div>
                <div class="card-block">
                	<form action="{{ route('faculty.update.subject.student.grades.post') }}" method="POST">
                		{{ csrf_field() }}
                		<input type="hidden" name="student_id" value="{{ $student->id }}">
                		<input type="hidden" name="subject_id" value="{{ $subject->id }}">
                		<input type="hidden" name="gid" value="{{ $gid }}">
						@foreach($grades as $g)
							@if($g->term_id == 1)
								<div class="form-group">
									<label for="prelim">Prelim</label>
									<input type="number" name="prelim" id="prelim" value="{{ $g->grade }}" class="form-control underlined">
								</div>
							@endif
							@if($g->term_id == 2)
								<div class="form-group">
									<label for="midterm">Midterm</label>
									<input type="number" name="midterm" id="midterm" value="{{ $g->grade }}" class="form-control underlined">
								</div>
							@endif
							@if($g->term_id == 3)
								<div class="form-group">
									<label for="semi_final">Semi Final</label>
									<input type="number" name="semi_final" id="semi_final" value="{{ $g->grade }}" class="form-control underlined">
								</div>
							@endif
							@if($g->term_id == 4)
								<div class="form-group">
									<label for="final">Final</label>
									<input type="number" name="final" id="final" value="{{ $g->grade }}" class="form-control underlined">
								</div>
							@endif
						@endforeach
						<div class="form-group">
							<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update Grades</button>
						</div>
					</form>
                </div>
                <div class="card-footer"> <small>Student</small> </div>
            </div>
		</div>
	</div>
</section>
@endsection