<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Delivery</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo base_url();?>/assets_home/home/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>/assets_home/home/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>/assets_home/home/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>/assets_home/home/css/style.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="assets_home/logo1.png">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: "textarea.mce",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            menubar: false,
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArF0QiK8CUtO3LCvBUoN1cMiHhsTbfIEg&callback=initMap">
        type = "text/javascript"
    </script>

    <script src="<?= base_url() ?>includes/script.js"></script>
    <style>
        #right-panel {
            font-family: 'Roboto', 'sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }

        #right-panel select,
        #right-panel input {
            font-size: 15px;
        }

        #right-panel select {
            width: 100%;
        }

        #right-panel i {
            font-size: 12px;
        }

        #map {
            height: 500px;
            float: left;
            width: 63%;
        }

        #right-panel {
            float: right;
            height: 500px;
            overflow: auto;
        }

        .panel {
            height: 500px;
            overflow: auto;
        }
    </style>
</head>

<body>
    <?php if ($this->session->flashdata('alert')) : ?>
        <script>
            alert("<?php echo $this->session->flashdata('alert'); ?>");
        </script>
    <?php endif; ?>
    <div class="container-fluid bg-dark">
        <div class="container">
            <nav class="navbar navbar-dark navbar-expand-lg py-lg-0">
                <a href="index.php" class="navbar-brand">
                    <h1 class="text-primary mb-0 display-5">Delivery <span class="text-white"></span></h1>
                </a>
                <button class="navbar-toggler bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-dark"></span>
                </button>
                <div class="collapse navbar-collapse me-n3" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <?php if ($this->session->userdata('pengguna')) {
                        ?>
                            <a href="<?= base_url('home') ?>" class="nav-item nav-link ">Home</a>
                            <a href="<?= base_url('home/pengiriman') ?>" class="nav-item nav-link ">Pengiriman</a>
                            <a href="<?= base_url('home/kontak') ?>" class="nav-item nav-link ">Kontak</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Akun</a>
                                <div class="dropdown-menu m-0 bg-primary">
                                    <a href="<?= base_url('home/profil') ?>" class="dropdown-item">Profil</a>
                                    <a href="<?= base_url('home/riwayat') ?>" class="dropdown-item">Riwayat</a>
                                    <a href="<?= base_url('auth/logout') ?>" class="dropdown-item">Keluar</a>
                                </div>
                            </div>
                        <?php } else { ?>
                            <a href="<?= base_url('auth/daftar') ?>" class="nav-item nav-link">Daftar</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Login</a>
                                <div class="dropdown-menu m-0 bg-primary">
                                    <a href="<?= base_url('auth/login') ?>" class="dropdown-item">Login User</a>
                                    <a href="<?= base_url('auth/loginadmin') ?>" class="dropdown-item">Login Admin</a>
                                    <a href="<?= base_url('auth/loginkurir') ?>" class="dropdown-item">Login Kurir</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>