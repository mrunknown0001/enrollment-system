<button class="btn btn-danger" type="button" data-toggle="modal" data-target="#activationPrompt">Deactivate Enrollment</button>

<div class="modal fade" id="activationPrompt">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="fa fa-info"></i> Enrollment De-Activation Prompt</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to deactivate Enrollment?</p>
                <form class="" action="{{ route('admin.enrollment.setting.post') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="enrollment_switch" value="off">
                    <button type="submit" class="btn btn-danger btn-sm">De-Activate</button>
                    
                </form>
            </div>
            <div class="modal-footer">
                <small>Enrollment Activation</small>
            </div>
        </div>
    </div>
</div>