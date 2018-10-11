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
			<th class="text-center">Name</th>
			<th class="text-center">Username</th>
			<th class="text-center">ID Number</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($registrars as $c)
		<tr>
			<td class="text-center">{{ ucwords($c->firstname . ' ' . $c->lastname) }}</td>
			<td class="text-center">{{ strtolower($c->username) }}</td>
			<td class="text-center">{{ strtoupper($c->id_number) }}</td>
			<td class="text-center">
				<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#registrar-{{ $c->id }}"><i class="fa fa-eye"></i> View</button>
				<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#reset-{{ $c->id }}"><i class="fa fa-key"></i> Reset Password</button>
				<button class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#remove-{{ $c->id }}"><i class="fa fa-trash"></i> Remove</button>
			</td>
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
				<div class="modal fade" id="reset-{{ $c->id }}">
				    <div class="modal-dialog" role="document">
				        <div class="modal-content">
				            <div class="modal-header">
				                <h4 class="modal-title">
				                    <i class="fa fa-info"></i> Reset Password</h4>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                    <span aria-hidden="true">&times;</span>
				                </button>
				            </div>
				            <div class="modal-body">
				                <p>Are you sure you want to reset password to default for {{ ucwords($c->firstname . ' ' . $c->lastname) }}?</p>
				                <form action="{{ route('admin.reset.registrar.password.post') }}" method="POST">
				                	{{ csrf_field() }}
				                	<input type="hidden" name="id" value="{{ $c->id }}">
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Reset Password</button>
									</div>
				                </form>
				            </div>
				            <div class="modal-footer">
				                <small>Reset Password</small>
				            </div>
				        </div>
				    </div>
				</div>

				<div class="modal fade" id="remove-{{ $c->id }}">
				    <div class="modal-dialog" role="document">
				        <div class="modal-content">
				            <div class="modal-header">
				                <h4 class="modal-title">
				                    <i class="fa fa-info"></i> Remove Registrar</h4>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                    <span aria-hidden="true">&times;</span>
				                </button>
				            </div>
				            <div class="modal-body">
				                <p>Are you sure you want to remove {{ ucwords($c->firstname . ' ' . $c->lastname) }}?</p>
				                <form action="{{ route('admin.remove.registrar.post') }}" method="POST">
				                	{{ csrf_field() }}
				                	<input type="hidden" name="id" value="{{ $c->id }}">
									<div class="form-group">
										<button type="submit" class="btn btn-danger">Remove Registrar</button>
									</div>
				                </form>
				            </div>
				            <div class="modal-footer">
				                <small>Remove Registrar</small>
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