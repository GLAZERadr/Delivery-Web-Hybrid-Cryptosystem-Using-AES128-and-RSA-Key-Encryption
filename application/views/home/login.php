
<div class="container-fluid page-header py-5">
    <div class="container text-center py-5">
        <h1 class="display-2 text-white mb-4 animated slideInDown">Login</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0 animated slideInDown">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item text-white" aria-current="page">Login</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h5 class="mb-2 px-3 py-1 text-dark rounded-pill d-inline-block border border-2 border-primary">Login</h5>
            <h1 class="display-5 w-50 mx-auto">Login</h1>
        </div>
        <div class="row g-5 mb-5">
            <div class="col-lg-12">
                <div class="rounded contact-form">
                    <form method="post" action="<?= base_url('home/logincek') ?>">
                        <div class="mb-4">
                            <label class="mb-2">Username</label>
                            <input type="username" class="form-control p-3" name="username" placeholder="Masukkan username">
                        </div>
                        <div class="mb-4">
                            <label class="mb-2">Password</label>
                            <input type="password" class="form-control p-3" name="password" placeholder="Masukkan Password">
                        </div>
                        <button class="btn btn-primary border-0 py-3 px-4 rounded-pill float-end" name="simpan" type="submit">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
