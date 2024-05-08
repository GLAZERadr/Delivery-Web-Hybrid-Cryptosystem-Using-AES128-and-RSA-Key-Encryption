<!-- Page Heading -->
<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Admin</h1>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="<?= base_url('admin/admintambah') ?>" class="btn btn-primary btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah</span>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="10px">NO</th>
                        <th>Nama Admin</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th width="">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php foreach ($admin as $data) { ?>
                        <tr>
                            <td><?php echo $nomor ?></td>
                            <td><?= $data['namaadmin'] ?></td>
                            <td><?= $data['username'] ?></td>
                            <td><?= $data['password'] ?></td>
                            <td>
                                <a href="<?= base_url('admin/adminedit/' . $data['idadmin']) ?>" class="btn btn-warning btn-sm">Ubah</a>
                                <a href="<?= base_url('admin/adminhapus/' . $data['idadmin']) ?>" class="btn btn-danger btn-sm bdel">Hapus</a>
                            </td>

                        </tr>
                        <?php $nomor++; ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>