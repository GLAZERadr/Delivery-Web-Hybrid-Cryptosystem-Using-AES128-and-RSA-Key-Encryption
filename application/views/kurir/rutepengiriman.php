<?php
$aes = new AES128Encryption("AdrianBadjideh11");

$lat_kurir = $aes->decrypt($pengiriman['lat']);
$lang_kurir = $aes->decrypt($pengiriman['lang']);
$lat_penerima = $pengiriman['lat_penerima'];
$lang_penerima = $pengiriman['lang_penerima'];
$lat_pengirim = $pengiriman['lat_pengirim'];
$lang_pengirim = $pengiriman['lang_pengirim'];

$alamatpengirim = $pengiriman['alamatpengirim'];
$alamatpenerima = $pengiriman['alamatpenerima'];
$namapengirim = $pengiriman['namapengirim'];
$namapenerima = $pengiriman['namapenerima'];
?>



<div class="container-fluid">
    <!-- Page Heading -->


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <span class="text">Rute Pengiriman</span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 p">
                    <div class="h-100">
                        Kode Pengiriman : <strong><?= $pengiriman['kodepengiriman'] ?></strong>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="map" style="width: 100%; height: 400px;"></div>
                </div>
                <div class="col-md-6">
                    <div id="right-panel"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArF0QiK8CUtO3LCvBUoN1cMiHhsTbfIEg&callback=initMap">
</script>
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 9,
            center: {
                lat: <?= $lat_pengirim ?>,
                lng: <?= $lang_pengirim ?>
            }
        });

        var directionsService = new google.maps.DirectionsService();
        var directionsRenderer = new google.maps.DirectionsRenderer({
            draggable: false,
            map: map,
            panel: document.getElementById('right-panel')
        });

        var pengirimMarker = new google.maps.Marker({
            position: {
                lat: <?= $lat_pengirim ?>,
                lng: <?= $lang_pengirim ?>
            },
            map: map,
            title: 'Pengirim: <?= $namapengirim ?>',
            label: 'Pengirim',
            icon: 'https://maps.google.com/mapfiles/ms/icons/green-dot.png' // Icon untuk marker pengirim
        });

        var penerimaMarker = new google.maps.Marker({
            position: {
                lat: <?= $lat_penerima ?>,
                lng: <?= $lang_penerima ?>
            },
            map: map,
            title: 'Penerima: <?= $namapenerima ?>',
            label: 'Penerima',
            icon: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png' // Icon untuk marker penerima
        });

        // Tambahkan info window untuk menampilkan alamat pengirim dan penerima
        var infoWindowPengirim = new google.maps.InfoWindow({
            content: '<strong>Nama Pengirim:</strong> <?= $namapengirim ?><br><strong>Alamat Pengirim:</strong> <?= $alamatpengirim ?>'
        });

        var infoWindowPenerima = new google.maps.InfoWindow({
            content: '<strong>Nama Penerima:</strong> <?= $namapenerima ?><br><strong>Alamat Penerima:</strong> <?= $alamatpenerima ?>'
        });

        // Tampilkan info window saat marker di-klik
        pengirimMarker.addListener('click', function() {
            infoWindowPengirim.open(map, pengirimMarker);
        });

        penerimaMarker.addListener('click', function() {
            infoWindowPenerima.open(map, penerimaMarker);
        });

        var request = {
            origin: {
                lat: <?= $lat_pengirim ?>,
                lng: <?= $lang_pengirim ?>
            },
            destination: {
                lat: <?= $lat_penerima ?>,
                lng: <?= $lang_penerima ?>
            },
            travelMode: google.maps.TravelMode.DRIVING
        };

        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsRenderer.setDirections(response);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    }
</script>