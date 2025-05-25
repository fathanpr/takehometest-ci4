<div id="modal-input" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-heading" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= route_to('users.store') ?>" id="form-input" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-heading">Add User
                </h4>
                <button type="button" class="btn-close btnCloseInput" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="department_id">Department</label>
                        <select class="form-select" id="department_id" name="department_id" style="width:100%;" required>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btnCloseInput" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->