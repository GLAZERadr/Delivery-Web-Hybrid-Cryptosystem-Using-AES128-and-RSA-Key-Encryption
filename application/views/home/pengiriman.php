<div class="container-fluid page-header py-5">
    <div class="container text-center py-5">
        <h1 class="display-2 text-white mb-4 animated slideInDown">Pengiriman</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0 animated slideInDown">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item text-white" aria-current="page">Pengiriman</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-fluid">
    <div class="container py-5">
        <div class="bg-light px-4 py-5 rounded">
            <form class="mb-4" method="post" action="<?= base_url('home/pengirimanrekap') ?>">
                <div class="row g-4">
                    <div class="col-xl-12 col-lg-12">
                        <div class="row">
                            <h5>Pengirim</h5>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control" name="namapengirim" required>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <input type="number" class="form-control" name="nohppengirim" required>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamatpengirim" required></textarea>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Lat</label>
                                    <input type="text" class="form-control" id="latInputPengirim" name="lat_pengirim" required>
                                </div>
                                <div class="form-group">
                                    <label>Lng</label>
                                    <input type="text" class="form-control" id="lngInputPengirim" name="lang_pengirim" required>
                                </div>
                                <div class="form-group">
                                    <button type="button" id="selectLocationBtn" class="btn btn-primary mt-3">Pilih Lokasi</button>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Pilih Lewat Map</label><br>
                                <div id="mapPengirim" style="height: 300px;"></div>
                            </div>

                            <hr>
                            <h5>Penerima</h5>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control" name="namapenerima" required>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <input type="number" class="form-control" name="nohppenerima" required>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamatpenerima" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Lat</label>
                                    <input type="text" class="form-control" id="latInput" name="lat_penerima" required>
                                </div>
                                <div class="form-group">
                                    <label>Lng</label>
                                    <input type="text" class="form-control" id="lngInput" name="lang_penerima" required>
                                </div>
                                <div class="form-group">
                                    <button type="button" id="selectLocationBtnPengirim" class="btn btn-primary mt-3">Pilih Lokasi</button>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Pilih Lewat Map</label><br>
                                <div id="map" style="width: 100%; height: 300px;"></div>
                            </div>

                            <hr>
                            <h5>Detail Paket</h5>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Jenis barang</label>
                                    <input type="text" class="form-control" id="" name="jenisbarang" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Berat (*kg)</label>
                                    <input type="number" class="form-control" id="berat" name="berat" onchange="calculateCost()"  required>
                                </div>
                            </div>
                            <div class=" col-md-12 mb-3">
                                    <div class="form-group">
                                        <label>Jenis Layanan</label>
                                        <select name="jenislayanan" id="jenis" class="form-select" onchange="calculateCost()">
                                            <option value="Reguler">Reguler</option>
                                            <option value="Sameday">Sameday</option>
                                            <option value="Hemat">Hemat</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label>Biaya (Rp)</label>
                                        <input type="text" class="form-control" id="biaya" name="biaya" required readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary w-100 p-3 border-0">Selanjutnya</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>

<script>
    function calculateCost() {
        var jenislayanan = document.getElementById('jenis').value;
        var berat = document.getElementById('berat').value;

        var biaya = 0;

        if (jenislayanan == 'Reguler') {
            biaya = 15000;
        } else if (jenislayanan == 'Sameday') {
            biaya = 20000;
        } else if (jenislayanan == 'Hemat') {
            biaya = 10000;
        }

        var totalBiaya = biaya * berat;

        document.getElementById('biaya').value = totalBiaya;
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArF0QiK8CUtO3LCvBUoN1cMiHhsTbfIEg&callback=initMap">
    type = "text/javascript"
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mapOptions = {
            center: {
                lat: -2.990934,
                lng: 104.756554
            },
            zoom: 15,
        };

        // Inisialisasi peta Google Maps
        const map = new google.maps.Map(document.getElementById('map'), mapOptions);

        // Buat marker untuk menunjukkan lokasi yang dipilih
        const marker = new google.maps.Marker({
            map: map,
            draggable: true,
        });

        // Event saat marker digeser (diubah posisinya)
        google.maps.event.addListener(marker, 'dragend', function(event) {
            // Ambil latitude dan longitude dari posisi marker saat ini
            const lat = event.latLng.lat();
            const lng = event.latLng.lng();

            // Masukkan nilai lat dan lng ke dalam input form
            document.getElementById('latInput').value = lat.toFixed(6); // Bulatkan menjadi 6 digit di belakang koma
            document.getElementById('lngInput').value = lng.toFixed(6);
        });

        // Event saat tombol "Pilih Lokasi" ditekan
        document.getElementById('selectLocationBtn').addEventListener('click', function() {
            const mapContainer = document.getElementById('map');
            map.setCenter(marker.getPosition()); // Geser peta agar marker berada di tengah
        });

        // Event saat peta di-klik untuk menambahkan marker
        google.maps.event.addListener(map, 'click', function(event) {
            marker.setPosition(event.latLng); // Geser marker ke lokasi yang di-klik
            const lat = event.latLng.lat();
            const lng = event.latLng.lng();
            document.getElementById('latInput').value = lat.toFixed(6);
            document.getElementById('lngInput').value = lng.toFixed(6);
        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mapOptionsPengirim = {
            center: {
                lat: -2.990934,
                lng: 104.756554
            },
            zoom: 15,
        };

        // Inisialisasi peta Google Maps untuk pengirim
        const mapPengirim = new google.maps.Map(document.getElementById('mapPengirim'), mapOptionsPengirim);

        // Buat marker untuk menunjukkan lokasi yang dipilih untuk pengirim
        const markerPengirim = new google.maps.Marker({
            map: mapPengirim,
            draggable: true,
        });

        // Event saat marker pengirim digeser (diubah posisinya)
        google.maps.event.addListener(markerPengirim, 'dragend', function(event) {
            // Ambil latitude dan longitude dari posisi marker saat ini
            const latPengirim = event.latLng.lat();
            const lngPengirim = event.latLng.lng();

            // Masukkan nilai lat dan lng ke dalam input form
            document.getElementById('latInputPengirim').value = latPengirim.toFixed(6); // Bulatkan menjadi 6 digit di belakang koma
            document.getElementById('lngInputPengirim').value = lngPengirim.toFixed(6);
        });

        // Event saat tombol "Pilih Lokasi" pengirim ditekan
        document.getElementById('selectLocationBtnPengirim').addEventListener('click', function() {
            const mapContainerPengirim = document.getElementById('mapPengirim');
            mapPengirim.setCenter(markerPengirim.getPosition()); // Geser peta agar marker berada di tengah
        });

        // Event saat peta pengirim di-klik untuk menambahkan marker
        google.maps.event.addListener(mapPengirim, 'click', function(event) {
            markerPengirim.setPosition(event.latLng); // Geser marker ke lokasi yang di-klik
            const latPengirim = event.latLng.lat();
            const lngPengirim = event.latLng.lng();
            document.getElementById('latInputPengirim').value = latPengirim.toFixed(6);
            document.getElementById('lngInputPengirim').value = lngPengirim.toFixed(6);
        });

    });
</script>