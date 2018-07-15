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
                        <p class="title"> Encode Remarks in {{ $program->code }} - {{ $program->description }} </p>
                    </div>
                </div>
                <div class="card-block">
					@if(count($students) > 0)
                    <form action="{{ route('faculty.encode.program.remarks.post') }}" method="POST" role="form">
                        {{ csrf_field() }}
                        <input type="hidden" name="program_id" value="{{ $program->id }}">
						<table class="table">
							<thead>
								<tr>
									<th>Name</th>
									<th>Student Number</th>
                                    <th>Remark</th>
								</tr>
							</thead>
							<tbody>
								@foreach($students as $s)
									<tr>
										<td>{{ ucwords($s->lastname . ', ' . $s->firstname) }}</td>
										<td>{{ $s->student_number }}</td>
                                        <td>
                                            <select name="{{ $s->student_number }}" class="form-control underlined">
                                                <option value="0">Not Competent</option>
                                                <option value="1">Competent</option>
                                            </select>
                                        </td>
									</tr>
								@endforeach
							</tbody>
							<tfoot></tfoot>
						</table>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save Remarks</button>
                        </div>
                    </form>
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