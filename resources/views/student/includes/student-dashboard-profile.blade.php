            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Student Profile </p>
                    </div>
                </div>
                <div class="card-block">

                    <div class="row">
                        <div class="col-md-8">
                            {{-- show data of enrolled course/program --}}
                            @if(Auth::user()->info->course_id != null)
                                <p>Enrolled to <strong>{{ Auth::user()->info->course->title }}</strong></p>
                            @else
                                <p>Enrolled to <strong>{{ Auth::user()->info->program->title }}</strong></p>
                            @endif

                            <p>Name: <strong>{{ ucwords(Auth::user()->firstname . ' ' . Auth::user()->lastname) }}</strong></p>
                            <p>Student Number: <strong>{{ Auth::user()->student_number }}</strong></p>
                            <p>Mobile Number: <strong>{{ Auth::user()->mobile_number }}</strong></p>
                            <p>Date of Birth: <strong>{{ date('F j, Y', strtotime(Auth::user()->info->date_of_birth)) }}</strong></p>
                            <p>Place of Birth: <strong>{{ ucwords(Auth::user()->info->place_of_birth) }}</strong></p>
                            <p>Address: <strong>{{ ucwords(Auth::user()->info->address) }}</strong></p>
                            <p>Nationality: <strong>{{ ucwords(Auth::user()->info->nationality) }}</strong></p>
                            @if(count(Auth::user()->info->sy_admitted) > 0)
                            <p>AY Admitted: <strong>{{ Auth::user()->info->sy_admitted->from . '-' . Auth::user()->info->sy_admitted->to }}</strong></p>
                            @endif
                            <p>School Last Attended: <strong>{{ ucwords(Auth::user()->info->school_last_attended) }}</strong></p>
                            <p>Year Graduated: <strong>{{ Auth::user()->info->date_graduated }}</strong></p>
                        </div>
                        <div class="col-md-4">
                            <img src="@if(Auth::user()->avatar) {{ asset('uploads/avatar/'.Auth::user()->avatar->avatar) }} @else {{ asset('uploads/avatar/avatar.png') }} @endif" alt="Avatar Image" height="200px" width="auto" style="border: 1px solid grey; margin: 5px;">
                            &nbsp;
                            <form action="{{ route('student.upload.profile.image.post') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="file" name="image" id="image" accept="image/x-png,image/gif,image/jpeg" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload Image</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer"> <small>Student Profile</small> </div>
            </div>