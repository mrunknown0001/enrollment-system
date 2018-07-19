@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')
<section class="section">
	<div class="row">
		<div class="col-md-12">
			<p><a href="{{ route('admin.view.rooms') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Rooms</a></p>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Add Room </p>
                    </div>
                </div>
                
                <div class="card-block">
                    @include('includes.all')
					<div class="row">
						<div class="col-md-6">
							<form action="{{ route('admin.add.room.post') }}" method="POST" role="form" autocomplete="off">
								{{ csrf_field() }}
								<div class="form-group">
									<label for="room_name">Room Name</label>
									<input type="text" name="room_name" id="room_name" class="form-control underlined" placeholder="Room Name">
								</div>
								<div class="form-group">
									<label for="room_number">Room Number</label>
									<input type="text" name="room_number" id="room_number" class="form-control underlined" placeholder="Room Number (Optional)">
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
								</div>
							</form>
						</div>
					</div>
                </div>
            </div>


		</div>
	</div>
</section>
@endsection