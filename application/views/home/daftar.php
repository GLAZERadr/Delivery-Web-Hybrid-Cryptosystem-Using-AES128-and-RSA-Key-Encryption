<div class="container-fluid page-header py-5">
    <div class="container text-center py-5">
        <h1 class="display-2 text-white mb-4 animated slideInDown">Daftar</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0 animated slideInDown">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item text-white" aria-current="page">Daftar</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h5 class="mb-2 px-3 py-1 text-dark rounded-pill d-inline-block border border-2 border-primary">Daftar</h5>
            <h1 class="display-5 w-50 mx-auto">Daftar</h1>
        </div>
        <div class="row g-5 mb-5">
            <div class="col-lg-6 ">
                <div class="h-100">
                    <img style="height: 650px;object-fit:cover;border-radius:5%" width="100%" src="<?= base_url() ?>assets_home/home/img/g2.jpg">
                </div>
            </div>
            <div class="col-lg-6 ">
                <div class="rounded contact-form">
                    <form method="post" action="<?= base_url('home/daftarsimpan') ?>">
                        <div class="mb-4">
                            <label class="mb-2">Nama</label>
                            <input type="text" class="form-control p-3" name="nama" placeholder="Masukkan Nama" required>
                        </div>
                        <div class="mb-4">
                            <label class="mb-2">Username</label>
                            <input type="username" class="form-control p-3" name="username" placeholder="Masukkan username" required>
                        </div>
                        <div class="mb-4">
                            <label class="mb-2">Password</label>
                            <input type="password" class="form-control p-3" name="password" placeholder="Masukkan Password" required>
                        </div>
                        <div class="mb-4">
                            <label class="mb-2">No. Telepon</label>
                            <input type="number" class="form-control p-3" name="nohp" placeholder="Masukkan No Telepon" required>
                        </div>
                        <button class="btn btn-primary border-0 py-3 px-4 rounded-pill float-end" name="daftar" type="submit">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>