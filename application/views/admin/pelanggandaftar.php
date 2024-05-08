<!-- Page Heading -->
<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Pelanggan</h1>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="10px">NO</th>
                        <th>Nama Pelanggan</th>
                        <th>Username</th>
                        <th>No Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php foreach ($pelanggan as $data) { ?>
                        <tr>
                            <td><?php echo $nomor ?></td>
                            <td><?= $data['namapelanggan'] ?></td>
                            <td><?= $data['username'] ?></td>
                            <td><?= $data['nohp'] ?></td>
                        </tr>
                        <?php $nomor++; ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>