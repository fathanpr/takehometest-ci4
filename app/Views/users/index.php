
<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
    <?= $pageTitle ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
   <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between pb-3">
                            <h4 class="header-title mb-3">List Users</h4>
                            <div class="d-flex gap-1">
                                <button type="button" class="btn btn-success btnInput">
                                    <i class="mdi mdi-plus"></i> Tambah
                                </button>
                                <button type="button" class="btn btn-info btnReload">
                                    <i class="mdi mdi-refresh"></i> Reload
                                </button>
                                <br>
                            </div>
                        </div>
                    </div>
                    <table id="datatable" class="table table-striped nowrap w-100">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Departemen</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div>
    <?= $this->include('users/modal-input') ?>
    <?= $this->include('users/modal-edit') ?>
<?= $this->endSection() ?>