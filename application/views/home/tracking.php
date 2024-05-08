<!-- Tambahan CSS untuk mengatur tinggi peta -->
<style>
    #map {
        height: 400px;
    }

    #right-panel {
        height: 400px;
        overflow-y: auto;
    }
</style>
<!-- Konten HTML -->
<div class="container-fluid page-header py-5">
    <div class="container text-center py-5">
        <h1 class="display-2 text-white mb-4 animated slideInDown">Tracking</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0 animated slideInDown">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item text-white" aria-current="page">Tracking</li>
            </ol>
        </nav>
    </div>
</div>

<?php
// Periksa apakah data pengiriman tersedia
if ($pengiriman) {
    $lat_kurir = $pengiriman['lat'];
    $lang_kurir = $pengiriman['lang'];
    $lat_penerima = $pengiriman['lat_penerima'];
    $lang_penerima = $pengiriman['lang_penerima'];
?>

    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mb-5 p">
                <h5 class="mb-2 px-3 py-1 text-dark rounded-pill d-inline-block border border-2 border-primary">Tracking</h5>
                <h1 class="display-5 w-50 mx-auto">Tracking</h1>
            </div>
            <div class="row">
                <div class="col-lg-12 p">
                    <div class="h-100">
                        Kode Pengiriman : <strong><?= $pengiriman['kodepengiriman'] ?></strong>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="map" style="width: 100%;"></div>
                </div>
                <div class="col-md-6">
                    <div id="right-panel" style="  height: 400px;
        overflow-y: auto;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk memuat peta Google Maps -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArF0QiK8CUtO3LCvBUoN1cMiHhsTbfIEg&callback=initMap">
    </script>

    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 9,
                center: {
                    lat: <?= $lat_penerima ?>,
                    lng: <?= $lang_penerima ?>
                }
            });

            var directionsService = new google.maps.DirectionsService();
            var directionsRenderer = new google.maps.DirectionsRenderer({
                draggable: false,
                map: map,
                panel: document.getElementById('right-panel')
            });

            var request = {
                origin: {
                    lat: <?= $lat_penerima ?>,
                    lng: <?= $lang_penerima ?>
                },
                destination: {
                    lat: <?= $lat_kurir ?>,
                    lng: <?= $lang_kurir ?>
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
<?php
} else {
?>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mb-5 p">
                <h5 class="mb-2 px-3 py-1 text-dark rounded-pill d-inline-block border border-2 border-primary">Tracking</h5>
                <h1 class="display-5 w-50 mx-auto">Tracking</h1>
            </div>
            <div class="row">
                <div class="col-lg-12 p">
                    <div class="h-100">
                        <h5 class="alert alert-danger">Kode Pengiriman Tidak Ditemukan</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>