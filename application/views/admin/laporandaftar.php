<!-- Page Heading -->
<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Laporan</h1>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="10px">NO</th>
                        <th>Tanggal</th>
                        <th>Kode Kirim</th>
                        <th>Nama Pengirim</th>
                        <th>Alamat Pengirim</th>
                        <th>Telepon Pengirim</th>
                        <th>Nama Penerima</th>
                        <th>Alamat Penerima</th>
                        <th>Telepon Penerima</th>
                        <th>Jenis Barang</th>
                        <th>Status Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php foreach ($pengiriman as $data) { ?>
                        <tr>
                            <td><?php echo $nomor ?></td>
                            <td><?= tanggal($data['tanggal']) ?></td>
                            <td><?= $data['kodepengiriman'] ?></td>
                            <td><?= $data['namapengirim'] ?></td>
                            <td><?= $data['alamatpengirim'] ?></td>
                            <td><?= $data['nohppengirim'] ?></td>
                            <td><?= $data['namapenerima'] ?></td>
                            <td><?= $data['alamatpenerima'] ?></td>
                            <td><?= $data['nohppenerima'] ?></td>
                            <td><?= $data['jenisbarang'] ?></td>
                            <td><?= $data['status'] ?></td>
                        </tr>
                        <?php $nomor++; ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>