<?php

$sub_path = "/kas";

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/kas'>Kas</a></li>
    <li class='breadcrumb-item'><a href='/kas/create'>Tambah Data</a></li>
";

$title = "Tambah Data Kas";
$subtitle = "Halaman ini digunakan untuk menambah data kas.";

require_once VIEW_PATH . "layouts/header.php";
?>

<?php alertMessage() ?>
<section class="section mb-4">
    <div class="card">
        <div class="card-header pb-2 d-flex justify-content-between align-items-center">
            <p class="mb-0">
                Form Tambah Data
            </p>
            <div class="badge bg-light-success">
                <?= codeKas() ?>
            </div>
        </div>
        <hr class="mx-4">
        <div class="card-content">
            <div class="card-body">
                <form action="/kas/store" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label for="besaran_kas" class="mb-2">Besaran Kas <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">#</span>
                                <input type="number" name="besaran_kas" id="besaran_kas" class="form-control <?= error("besaran_kas") ?>" placeholder="Masukkan besaran_kas..." value="<?= old("besaran_kas") ?>">
                                <?php errorMessage("besaran_kas") ?>
                            </div>
                        </div>
                       <div class="col-lg mb-4">
                            <label for="tipe_kas" class="mb-2">Tipe Kas <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Text</span>
                                <select class="form-select <?= error("tipe_kas") ?>" id="tipe_kas" name="tipe_kas">
                                    <option value="" selected>Pilih Tipe Kas</option>
                                    <option value="pemasukan" <?= old("tipe_kas") == "pemasukan" ? "selected" : "" ?>>Pemasukan</option>
                                    <option value="pengeluaran" <?= old("tipe_kas") == "pengeluaran" ? "selected" : "" ?>>Pengeluaran</option>
                                </select>
                                <?php errorMessage("tipe_kas") ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label for="keterangan" class="mb-2">Keterangan <span class="text-danger">*</span></label>
                            <div class="form-group ">
                                <textarea class="form-control <?= error("keterangan") ?>" name="keterangan" id="keterangan" style="height: 150px;" placeholder="Masukkan keterangan..."><?= old("keterangan") ?></textarea>
                                <?php errorMessage("keterangan") ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto ms-auto">
                            <button type="reset" class="btn px-4">Reset</button>
                            <button type="submit" class="btn btn-primary px-4">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once VIEW_PATH . "layouts/footer.php" ?>