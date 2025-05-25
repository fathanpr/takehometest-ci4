<div id="modal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-heading" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="#" id="form-edit" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-heading">Edit User
                    </h4>
                    <button type="button" class="btn-close btnCloseEdit" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="form-group mb-3">
                            <label for="nameEdit">Name</label>
                            <input type="text" class="form-control" id="nameEdit" name="nameEdit" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="usernameEdit">Username</label>
                            <input type="text" class="form-control" id="usernameEdit" name="usernameEdit" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="emailEdit">Email</label>
                            <input type="text" class="form-control" id="emailEdit" name="emailEdit" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="department_idEdit">Department</label>
                            <select class="form-select" id="department_idEdit" name="department_idEdit" required style="width:100%;" required>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="passwordEdit">Password</label>
                            <input type="password" class="form-control" id="passwordEdit" name="passwordEdit">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_confirmationEdit">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmationEdit" name="password_confirmationEdit">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btnCloseEdit" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->