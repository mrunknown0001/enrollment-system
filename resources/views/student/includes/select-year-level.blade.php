<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <div class="header-block">
                    <p class="title"> Select Year Level </p>
                </div>
            </div>
            
            <div class="card-block">
                <form id="signup-form" action="{{ route('student.year.level.select.post') }}" method="POST" role="form" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <select class="form-control underlined" name="year_level" id="year_level" required="">
                            <option value="">Select One</option>
                            <option value="1">First Year</option>
                            <option value="2">Second Year</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
                        <a href="{{ route('student.cancel.enrollment.for') }}" class="btn btn-danger">Cancel Enrollment</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>