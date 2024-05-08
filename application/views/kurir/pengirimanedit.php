<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
            Update Lokasi
        </h4>
    </div>
    <div class="card-body">
        <form id="updateLocationForm" method="post" action="<?= base_url('kurir/updatestatus/' . $pengiriman['idpengiriman']) ?>" enctype="multipart/form-data">
            <div class="body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Kode Pengiriman<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" readonly value="<?= $pengiriman['kodepengiriman'] ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Ubah Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status">
                                <option value="Sedang Dalam Perjalanan" <?= $pengiriman['status'] == 'Sedang Dalam Perjalanan' ? 'selected' : '' ?>>Sedang Dalam Perjalanan</option>
                                <option value="Sudah Di Kirim" <?= $pengiriman['status'] == 'Sudah Di Kirim' ? 'selected' : '' ?>>Sudah Di Kirim</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Keterangan<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="keterangan" value="<?= $pengiriman['keterangan'] ?>">
                        </div>
                    </div>
                </div>
                <hr class="sidebar-divider">
                <button class="btn btn-primary float-right" type="submit" name="edit"><i class="fas fa-save"></i> Edit</button>
            </div>
        </form>
    </div>
</div>