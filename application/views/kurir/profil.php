<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
            Edit Profil
        </h4>
    </div>
    <div class="card-body">
        <form method="post" action="<?= base_url('kurir/profiledit/' . $kurir['idkurir']) ?>" enctype="multipart/form-data">
            <div class="body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nama Kurir <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="namakurir" name="namakurir" value="<?= $kurir['namakurir'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">No Telepon <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="nohp" name="nohp" min="0" value="<?= $kurir['nohp'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $kurir['username'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password <span class="text-danger">*</span></label>
                            <input type="hidden" class="form-control" id="passwordlama" name="passwordlama" value="<?= $kurir['password'] ?>">
                            <input type="password" class="form-control" id="password" name="password">
                            <small class="text-danger">Kosongkan password jika tidak ingin mengubah.</small>
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