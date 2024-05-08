<!-- Page Heading -->
<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Pengiriman</h1>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="10px">NO</th>
                        <th>Kode Kirim</th>
                        <th>Nama Pengirim</th>
                        <th>Telepon Pengirim</th>
                        <th>Nama Penerima</th>
                        <th>Alamat Penerima</th>
                        <th>Telepon Penerima</th>
                        <th>Jenis Barang</th>
                        <th>Lokasi Terbaru</th>
                        <th>Keterangan</th>
                        <th width="">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php foreach ($pengiriman as $data) { ?>
                        <tr>
                            <td><?php echo $nomor ?></td>
                            <td><?= $data['kodepengiriman'] ?></td>
                            <td><?= $data['namapengirim'] ?></td>
                            <td><?= $data['nohppengirim'] ?></td>
                            <td><?= $data['namapenerima'] ?></td>
                            <td><?= $data['alamatpenerima'] ?></td>
                            <td><?= $data['nohppenerima'] ?></td>
                            <td><?= $data['jenisbarang'] ?></td>
                            <td>
                                <p>Latitude : <?= !empty($data['lat']) ? $data['lat'] : '-' ?></p>
                                <p>Longitude : <?= !empty($data['lang']) ? $data['lang'] : '-' ?></p>
                            </td>
                            <td><?= $data['keterangan'] ?></td>
                            <td>
                                <a href="<?= base_url('kurir/rutepengiriman/' . $data['kodepengiriman']) ?>" class="btn btn-info btn-sm m-1">Rute Pengiriman</a>
                                <a href="<?= base_url('kurir/pengirimanedit/' . $data['idpengiriman']) ?>" class="btn btn-primary btn-sm m-1">Edit Status</a>
                                <button class="btn btn-warning btn-sm m-1 update-btn" data-id="<?= $data['idpengiriman'] ?>">Update Lokasi</button>
                            </td>
                        </tr>
                        <?php $nomor++; ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Tambahkan event listener untuk setiap tombol "Update Lokasi"
    $(document).on('click', '.update-btn', function() {
        var id = $(this).data('id');
        var confirmUpdate = confirm('Apakah anda yakin ingin mengupdate lokasi saat ini ?');
        if (confirmUpdate) {
            updateLocation(id);
        }
    });

    // Fungsi untuk mengirim data posisi ke server
    function updateLocation(id) {
        // Cek apakah browser mendukung geolocation
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;

                // Kirim data posisi ke server menggunakan AJAX
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('kurir/updatelokasi/') ?>' + id, // Sesuaikan dengan URL yang benar
                    data: {
                        lat: lat,
                        lng: lng
                    },
                    success: function(response) {
                        // Tampilkan pesan sukses atau error jika diperlukan
                        alert('Posisi berhasil diperbarui!');
                        // Refresh halaman atau lakukan tindakan lain jika diperlukan
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan saat mengirim data!');
                        console.log(xhr.responseText);
                    }
                });
            }, function(error) {
                // Tangani error jika tidak dapat mengambil posisi
                alert('Error mengambil lokasi: ' + error.message);
            });
        } else {
            alert('Geolocation tidak mendukung pada browser ini.');
        }
    }
</script>