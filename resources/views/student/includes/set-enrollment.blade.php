<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <div class="header-block">
                    <p class="title"> Set Enrollment </p>
                </div>
            </div>
            
            <div class="card-block">
                <form id="signup-form" action="{{ route('student.enrollment.for.post') }}" method="POST" role="form" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <p><em>Please Choose One</em></p>
                    </div>
                    <div class="form-group">
                        <select class="form-control underlined" name="enrolling_for" id="enrolling_for" required="">
                            <option value="">Select One</option>
                            <option value="1">Course</option>
                            <option value="2">Program</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>