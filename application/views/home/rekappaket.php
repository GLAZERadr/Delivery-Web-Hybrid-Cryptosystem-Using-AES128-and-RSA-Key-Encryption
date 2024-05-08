<div class="container-fluid page-header py-5">
    <div class="container text-center py-5">
        <h1 class="display-2 text-white mb-4 animated slideInDown">Rekap Paket</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0 animated slideInDown">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item text-white" aria-current="page">Rekap Paket</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-fluid">
    <div class="container py-5">
        <div class="bg-light px-4 py-5 rounded">
            <form class="mb-4" method="post" action="<?= base_url('home/pengirimansubmit') ?>">
                <div class="row g-4">
                    <h2>Rekap Paket</h2>
                    <div class="col-xl-12 col-lg-12">
                        <div class="row">
                            <h5>Detail Pengiriman</h5>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Nama Pengirim</label>
                                    <input type="text" class="form-control" name="namapengirim" value="<?= $rekap_paket['namapengirim'] ?>" value="<?= $rekap_paket['namapengirim'] ?>" readonly>
                                    <input type="hidden" class="form-control" name="nohppengirim" value="<?= $rekap_paket['nohppengirim'] ?>" readonly>
                                    <input type="hidden" class="form-control" name="alamatpengirim" value="<?= $rekap_paket['alamatpengirim'] ?>" readonly>
                                    <input type="hidden" class="form-control" id="latInputPengirim" name="lat_pengirim" value="<?= $rekap_paket['lat_pengirim'] ?>" readonly>
                                    <input type="hidden" class="form-control" id="lngInputPengirim" name="lang_pengirim" value="<?= $rekap_paket['lang_pengirim'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Nama Penerima</label>
                                    <input type="text" class="form-control" name="namapenerima" value="<?= $rekap_paket['namapenerima'] ?>" readonly>
                                    <input type="hidden" class="form-control" name="nohppenerima" value="<?= $rekap_paket['nohppenerima'] ?>" readonly>
                                    <input type="hidden" class="form-control" name="alamatpenerima" value="<?= $rekap_paket['alamatpenerima'] ?>" readonly>
                                    <input type="hidden" class="form-control" id="latInput" name="lat_penerima" value="<?= $rekap_paket['lat_penerima'] ?>" readonly>
                                    <input type="hidden" class="form-control" id="lngInput" name="lang_penerima" value="<?= $rekap_paket['lang_penerima'] ?>" readonly>
                                </div>
                            </div>

                            <hr>
                            <h5>Detail Pengemasan</h5>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Jenis Layanan</label>
                                    <input type="text" class="form-control" id="jenislayanan" name="jenislayanan" value="<?= $rekap_paket['jenislayanan'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Jenis barang</label>
                                    <input type="text" class="form-control" id="" name="jenisbarang" value="<?= $rekap_paket['jenisbarang'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Berat (*kg)</label>
                                    <input type="number" class="form-control" id="berat" name="berat" value="<?= $rekap_paket['berat'] ?>" readonly>
                                </div>
                            </div>



                            <hr>
                            <h5>Waktu Pickup</h5>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Pilih Waktu Pickup </label>
                                    <input type="datetime-local" class="form-control" name="waktupickup" required>
                                </div>
                            </div>
                            <hr>
                            <h5>Rincian Pembayaran</h5>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Ongkos Kirim</label>
                                    <input type="text" class="form-control" value="<?= rupiah($rekap_paket['biaya']) ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Total Pembayaran</label>
                                    <input type="text" class="form-control" value="<?= rupiah($rekap_paket['biaya']) ?>" readonly>
                                    <input type="hidden" class="form-control" name="biaya" value="<?= ($rekap_paket['biaya']) ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary w-100 p-3 border-0">Pickup</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>