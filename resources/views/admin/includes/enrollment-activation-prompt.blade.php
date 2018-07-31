<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#deactivationPrompt">Activate Enrollment</button>

<div class="modal fade" id="deactivationPrompt">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="fa fa-info"></i> Enrollment Activation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to activate Enrollment?</p>
                <form class="" action="{{ route('admin.enrollment.setting.post') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="enrollment_switch" value="on">
                    <button type="submit" class="btn btn-primary btn-sm">Activate Enrollment</button>
                    
                </form>
            </div>
            <div class="modal-footer">
                <small>Enrollment Activation</small>
            </div>
        </div>
    </div>
</div>