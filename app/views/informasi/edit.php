<?php

$sub_path = "/informasi";

$id = $_GET["id"];

$title = "Edit Informasi Perpustakaan";
$subtitle = "Halaman ini digunakan untuk mengedit data informasi.";

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/informasi'>Informasi</a></li>
    <li class='breadcrumb-item'><a href='/informasi/edit'>Edit Data</a></li>
";

$informasi = first("informasi");

require_once VIEW_PATH . "layouts/header.php";
?>

<?php alertMessage() ?>
<section class="section mb-4">
    <div class="card">
        <div class="card-header pb-2">
            <p class="mb-0">
                Form Edit Data
            </p>
        </div>
        <hr class="mx-4">
        <div class="card-content">
            <div class="card-body">
                <form action="/informasi/update" method="POST" enctype="multipart/form-data">
                    <input hidden name="id" value="<?= $informasi->id ?>">
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label class="mb-2">Dibuat Pada</label>
                            <div class="input-group">
                                <input readonly value="<?= timeago("@" . $informasi->dibuat_pada) ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label class="mb-2">Terakhir Diedit</label>
                            <div class="input-group">
                                <input readonly value="<?= timeago("@" . $informasi->diedit_pada) ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label for="nama_perpustakaan" class="mb-2">Nama Perpustakaan <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Text</span>
                                <input name="nama_perpustakaan" id="nama_perpustakaan" class="form-control <?= error("nama_perpustakaan") ?>" placeholder="Masukkan nama perpustakaan..." value="<?= old("nama_perpustakaan", $informasi->nama_perpustakaan) ?>">
                                <?php errorMessage("nama_perpustakaan") ?>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label for="website" class="mb-2">Website <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Text</span>
                                <input name="website" id="website" class="form-control <?= error("website") ?>" placeholder="Masukkan website..." value="<?= old("website", $informasi->website) ?>">
                                <?php errorMessage("website") ?>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label for="email" class="mb-2">Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">@</span>
                                <input name="email" id="email" class="form-control <?= error("email") ?>" placeholder="Masukkan email..." value="<?= old("email", $informasi->email) ?>">
                                <?php errorMessage("email") ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                         <div class="col-lg mb-4">
                            <label for="tentang" class="mb-2">Tentang <span class="text-danger">*</span></label>
                            <div class="form-group ">
                                <textarea class="form-control <?= error("tentang") ?>" name="tentang" id="tentang" style="height: 150px;" placeholder="Masukkan tentang..."><?= old("tentang", $informasi->tentang) ?></textarea>
                                <?php errorMessage("tentang") ?>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label for="alamat" class="mb-2">Alamat <span class="text-danger">*</span></label>
                            <div class="form-group ">
                                <textarea class="form-control <?= error("alamat") ?>" name="alamat" id="alamat" style="height: 150px;" placeholder="Masukkan alamat..."><?= old("alamat", $informasi->alamat) ?></textarea>
                                <?php errorMessage("alamat") ?>
                            </div>
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="col-auto ms-auto">
                            <button type="reset" class="btn px-4">Reset</button>
                            <button type="submit" class="btn btn-primary px-4">Ubah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once VIEW_PATH . "layouts/footer.php" ?>