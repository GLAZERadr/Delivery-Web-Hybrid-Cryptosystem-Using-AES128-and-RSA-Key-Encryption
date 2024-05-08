<?php foreach ($pengiriman as $data) {
    $idkurir = $data['idkurir'];
    $lat_kurir = $data['lat'];
    $lang_kurir = $data['lang'];
} ?>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArF0QiK8CUtO3LCvBUoN1cMiHhsTbfIEg&callback=initMap">
</script>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Selamat Datang</h1>

    <!-- Dropdown Pilih Kurir -->
    <div class="mb-3">
        <label for="selectKurir" class="form-label">Pilih Kurir</label>
        <select class="form-control" id="selectKurir">
            <option value="all">Semua Kurir</option>
            <?php foreach ($kurir as $k) { ?>
                <option value="<?= $k['idkurir'] ?>"><?= $k['namakurir'] ?></option>
            <?php } ?>
        </select>
    </div>

    <!-- Tombol Tampilkan Map -->
    <button class="btn btn-primary mb-3" id="btnTampilkanMap">Tampilkan Map</button>

    <!-- Map dan Informasi Pengiriman -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <span class="text">Tracking</span>
        </div>
        <div class="card-body">
            <div id="map" style="width: 100%; height: 400px;"></div>
        </div>
    </div>
</div>

<script>
    var locations = [
        <?php foreach ($pengiriman as $data) { ?>['<?= $data['kodepengiriman'] ?>', '<?= $data['lat'] ?>', '<?= $data['lang'] ?>', '<?= $data['idkurir'] ?>', '<?= $data['idkurir'] ?>'],
        <?php } ?>
    ];

    var map; // Variabel global untuk objek map

    // Fungsi untuk mengupdate map sesuai pilihan kurir
    function updateMap(selectedKurir) {
        var filteredLocations = selectedKurir == 'all' ? locations : locations.filter(loc => loc[3] == selectedKurir);

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: {
                lat: <?= $lat_kurir ?>,
                lng: <?= $lang_kurir ?>
            }
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < filteredLocations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(filteredLocations[i][1], filteredLocations[i][2]),
                map: map,
                title: filteredLocations[i][0], // Tampilkan kode pengiriman sebagai judul marker
                icon: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png'
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent('<strong>Kode Pengiriman:</strong> ' + filteredLocations[i][0] + '<br><strong>Kurir:</strong> ' + filteredLocations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    }

    // Panggil fungsi updateMap() saat dropdown pilih kurir berubah
    document.getElementById('selectKurir').addEventListener('change', function() {
        var selectedKurir = this.value;
        updateMap(selectedKurir);
    });

    // Panggil updateMap() saat tombol Tampilkan Map diklik
    document.getElementById('btnTampilkanMap').addEventListener('click', function() {
        var selectedKurir = document.getElementById('selectKurir').value;
        updateMap(selectedKurir);
    });

    // Panggil updateMap() untuk memuat map awal
    updateMap('all');
</script>