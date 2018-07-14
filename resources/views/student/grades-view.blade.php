@extends('layouts.app')

@section('title') Student @endsection

@section('headside')
    @include('student.includes.header')
    @include('student.includes.side-menu')
@endsection


@section('content')
<p><strong>Grades for {{ $subject->code }} - {{ $subject->description }}</strong></p>
<p>{{ $sem->name }} | {{ $ay->from . '-' . $ay->to }}</p>
<section class="section">
	<div class="row">
		<div class="col-md-12">
			@include('includes.all')
			
			@if(count($grades) > 0)
				<table class="table table-bordered">
					@foreach($grades as $g)
						@if($g->term_id == 1)
							<tr>
								<td>Prelim</td>
								<td><strong>{{ $g->grade }}</strong></td>
							</tr>
						@endif
						@if($g->term_id == 2)
							<tr>
								<td>Midterm</td>
								<td><strong>{{ $g->grade }}</strong></td>
							</tr>
						@endif
						@if($g->term_id == 3)
							<tr>
								<td>Semi Final</td>
								<td><strong>{{ $g->grade }}</strong></td>
							</tr>
						@endif
						@if($g->term_id == 4)
							<tr>
								<td>Final</td>
								<td><strong>{{ $g->grade }}</strong></td>
							</tr>
						@endif
					@endforeach
				</table>
			@else
				<p>No Grades!</p>
			@endif

		</div>
	</div>
</section>
@endsection