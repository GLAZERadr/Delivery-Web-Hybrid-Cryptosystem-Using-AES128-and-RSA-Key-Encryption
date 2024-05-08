<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
            Edit Admin
        </h4>
    </div>
    <div class="card-body">
        <form method="post" action="<?= base_url('admin/admineditsimpan/' . $admin['idadmin']) ?>" enctype="multipart/form-data">
            <div class="body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nama Admin <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="namaadmin" name="namaadmin" value="<?= $admin['namaadmin'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $admin['username'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password <span class="text-danger">*</span></label>
                            <input type="hidden" class="form-control" id="passwordlama" name="passwordlama" value="<?= $admin['password'] ?>">
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                </div>
                <hr class="sidebar-divider">
                <button class="btn btn-primary float-right" type="submit" name="edit"><i class="fas fa-save"></i>
                    Edit</button>
            </div>
        </form>
    </div>
</div>