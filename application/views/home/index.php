<div class="container-fluid carousel px-0 mb-5 pb-5">
    <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
            <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img src="<?= base_url() ?>assets_home/home/img/bg2.jpg" class="img-fluid w-100" alt="First slide">
                <div class="carousel-caption">
                    <div class="container carousel-content">
                        <h4 class="text-white mb-4 animated slideInDown">Selamat Datang di Website</h4>
                        <h1 class="text-white display-1 mb-4 animated slideInDown">Delivery</h1>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= base_url() ?>assets_home/home/img/bg3.jpg" class="img-fluid w-100" alt="Second slide">
                <div class="carousel-caption">
                    <div class="container carousel-content">
                        <h4 class="text-white mb-4 animated slideInDown">Tempat Pengiriman Paket Terbaik</h4>
                        <h1 class="text-white display-1 mb-4 animated slideInDown">Delivery</h1>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev btn btn-primary border border-2 border-start-0 border-primary" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next btn btn-primary border border-2 border-end-0 border-primary" type="button" data-bs-target="#carouselId" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-12 my-auto wow fadeInUp" data-wow-delay="0.1s">
                <h3>Tracking Pengiriman</h3>
            </div>
            <div class="col-lg-12 my-auto wow fadeInUp" data-wow-delay="0.5s">
                <div class="h-100">
                    <form action="<?= base_url('home/inputtracking') ?>" method="post">
                        <div class="input-group mb-3">
                            <input type="text" name="kodepengiriman" class="form-control" placeholder="Masukkan Kode Pengiriman">
                            <button type="submit" class="btn btn-primary">Track</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>