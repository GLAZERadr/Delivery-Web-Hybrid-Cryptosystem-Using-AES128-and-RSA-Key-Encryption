<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
            Pengiriman Kurir
        </h4>
    </div>
    <div class="card-body">
        <form method="post" action="<?= base_url('admin/pengirimankurirsimpan/' . $pengiriman['idpengiriman']) ?>" enctype="multipart/form-data">
            <div class="body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Kode Pengiriman<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" readonly value="<?= $pengiriman['kodepengiriman'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Ubah Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status">
                                <option value="Di Tolak" <?= $pengiriman['status'] == 'Di Tolak' ? 'selected' : '' ?>>Di Tolak</option>
                                <option value="Di Setujui" <?= $pengiriman['status'] == 'Di Setujui' ? 'selected' : '' ?>>Di Setujui</option>
                                <option value="Sedang Dalam Perjalanan" <?= $pengiriman['status'] == 'Sedang Dalam Perjalanan' ? 'selected' : '' ?>>Sedang Dalam Perjalanan</option>
                                <option value="Sudah Di Kirim" <?= $pengiriman['status'] == 'Sudah Di Kirim' ? 'selected' : '' ?>>Sudah Di Kirim</option>
                                <option value="Selesai" <?= $pengiriman['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Ubah Ongkir (Rp)<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="biaya" value="<?= $pengiriman['biaya'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Pilih Kurir <span class="text-danger">*</span></label>
                            <select class="form-control" id="idkurir" name="idkurir">
                                <option value=""></option>
                                <?php foreach ($kurir as $row) { ?>
                                    <option value="<?= $row['idkurir'] ?>" <?= $row['idkurir'] == $pengiriman['idkurir'] ? 'selected' : '' ?>><?= $row['namakurir'] ?></option>
                                <?php } ?>
                            </select>
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