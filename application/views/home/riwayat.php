<div class="container-fluid page-header py-5">
    <div class="container text-center py-5">
        <h1 class="display-2 text-white mb-4 animated slideInDown">Riwayat Pengiriman</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0 animated slideInDown">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item text-white" aria-current="page">Riwayat Pengiriman</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-fluid">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-5 w-50 mx-auto">Riwayat Pengiriman</h1>
        </div>
        <div class="row g-5 mb-5">
            <div class="col-lg-12">
                <div class="rounded contact-form">
                    <table class="table">
                        <thead class="bg-warning text-white">
                            <tr class="text-center">
                                <th width="10px">No</th>
                                <th width="">Kode Pengiriman</th>
                                <th>Tanggal</th>
                                <th>Biaya</th>
                                <th>Kurir</th>
                                <th>Lokasi Terbaru</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 1; ?>
                            <?php include 'application/security/HybridCryptosystem.php';
                                $hybridCrypto = new HybridCryptosystem('application/security/encryption/public_key.pem', 'application/security/encryption/private_key.pem');
                            ?>
                            <?php foreach ($pengiriman as $row) {
                                $kurir = $this->db->where('idkurir', $row['idkurir'])->get('kurir')->row_array();
                            ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?= ($row['kodepengiriman']) ?></td>
                                    <td><?= tanggal($row['tanggal']) ?></td>
                                    <td> <?php if (!empty($row['biaya'])) {
                                                echo rupiah($row['biaya']);
                                            } else {
                                                echo "-";
                                            } ?>
                                    </td>
                                    <td>
                                        <?php if ($kurir) {
                                            echo $kurir['namakurir'];
                                        } else {
                                            echo "-";
                                        } ?>
                                    </td>
                                    <td>
                                        <p>Latitude : <?= !empty($row['lat']) ? $hybridCrypto->decryptData($row['lat']) : '-' ?></p>
                                        <p>Longitude : <?= !empty($row['lang']) ? $hybridCrypto->decryptData($row['lang']) : '-' ?></p>
                                    </td>
                                    <td><?= $row['status'] ?></td>
                                    <td><?= $row['keterangan'] ?></td>
                                    <td>
                                        <?php if (!empty($row['lat']) && !empty($row['lang'])) : ?>
                                            <a href="<?= base_url('pelanggan/tracking/' . $row['kodepengiriman']) ?>" class="btn btn-primary m-1">Tracking</a>
                                        <?php endif; ?>
                                        <?php if ($row['status'] == 'Sudah Di Kirim') : ?>
                                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalSelesai<?= $row['idpengiriman'] ?>">Konfirmasi Selesai</button>
                                        <?php endif; ?>
                                    </td>
                                    <div class="modal fade" id="modalSelesai<?= $row['idpengiriman'] ?>" tabindex="-1" aria-labelledby="modalSelesaiLabel<?= $row['idpengiriman'] ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="modalSelesaiLabel<?= $row['idpengiriman'] ?>">Konfirmasi Selesai Pengiriman</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menyelesaikan pengiriman ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <a href="<?= base_url('pelanggan/konfirmasiselesai/' . $row['idpengiriman']) ?>" class="btn btn-primary">Selesai</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                <?php $nomor++; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>