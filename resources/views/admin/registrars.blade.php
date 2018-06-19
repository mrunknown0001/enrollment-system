@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<p><strong>Registrars</strong></p>
@include('includes.all')

<p><a href="{{ route('admin.add.registrar') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Registrar</a></p>

@if(count($registrars) > 0)
<table class="table table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Username</th>
			<th>ID Number</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($registrars as $c)
		<tr>
			<td>{{ ucwords($c->firstname . ' ' . $c->lastname) }}</td>
			<td>{{ strtolower($c->username) }}</td>
			<td>{{ strtoupper($c->id_number) }}</td>
			<td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#registrar-{{ $c->id }}"><i class="fa fa-eye"></i> View</button></td>
			<div class="modal fade" id="registrar-{{ $c->id }}">
			    <div class="modal-dialog" role="document">
			        <div class="modal-content">
			            <div class="modal-header">
			                <h4 class="modal-title">
			                    <i class="fa fa-info"></i> Registrar Info</h4>
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true">&times;</span>
			                </button>
			            </div>
			            <div class="modal-body">
			                <p>Name: <strong>{{ ucwords($c->firstname . ' ' . $c->lastname) }}</strong></p>
			                <p>Username: <strong>{{ strtolower($c->username) }}</strong></p>
			                <p>ID Number: <strong>{{ $c->id_number }}</strong></p>
			                <p>Mobile Number: <strong>{{ $c->mobile_number }}</strong></p>
			            </div>
			            <div class="modal-footer">
			                <small>Registrar Info</small>
			            </div>
			        </div>
			    </div>
			</div>
		</tr>
		@endforeach
	</tbody>
	<tfoot>
		
	</tfoot>
</table>
@else
<p class="text-center"><em>No Registrar Found!</em></p>
@endif

{{ $registrars->links() }}
@endsection