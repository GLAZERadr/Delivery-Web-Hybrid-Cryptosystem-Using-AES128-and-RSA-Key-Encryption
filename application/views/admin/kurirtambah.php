<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
            Tambah Kurir
        </h4>
    </div>
    <div class="card-body">
        <form method="post" action="<?= base_url('admin/kurirtambahsimpan') ?>" enctype="multipart/form-data">
            <div class="body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nama Kurir <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="namakurir" name="namakurir" required>
                        </div>
                        <div class="form-group">
                            <label for="">No Telepon <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="nohp" name="nohp" min="0" required>
                        </div>
                        <div class="form-group">
                            <label for="">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                </div>
                <hr class="sidebar-divider">
                <button class="btn btn-primary float-right" type="submit" name="tambah"><i class="fas fa-save"></i>
                    Tambah</button>
            </div>
        </form>
    </div>
</div>