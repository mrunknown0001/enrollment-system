@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Select Course to View Curriculum</strong></p>
@include('includes.all')
<section class="section">
    <div class="row">
		<div class="col-md-6">
			
			<form action="" method="POST" autocomplete="off">
				{{ csrf_field() }}
				<div class="form-group">
					<select name="course" id="course" class="form-control">
						<option value="">Select Course</option>
					</select>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary"><i class="fa fa-arrow-right"></i> Continue</button>
				</div>
			</form>
			
		</div>
    </div>
</section>
@endsection