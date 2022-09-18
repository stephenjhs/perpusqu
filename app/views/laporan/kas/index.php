<?php

$sub_path = "/laporan/kas";

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/laporan'>Laporan</a></li>
    <li class='breadcrumb-item'><a href='/laporan/kas'>Kas</a></li>
";

$title = "Data Laporan Kas";
$subtitle = "Cetak laporan kas dengan format PDF.";

require_once VIEW_PATH . "layouts/header.php";
?>

<?php alertMessage() ?>
<section class="section mb-4">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-content">
                    <div class="card-header pb-2 d-flex justify-content-between align-items-center">
                        <p class="mb-0">
                            Laporan Data Kas
                        </p>
                        <div class="badge bg-info text-black">
                            <?= rp(sumWhere("kas", "tipe_kas", "pemasukan", "besaran_kas") - sumWhere("kas", "tipe_kas", "pengeluaran", "besaran_kas")) ?>
                        </div>
                    </div>
                    <hr class="mx-4">
                    <div class="card-body">
                        <form action="/laporan/kas/print" method="POST">
                            <input hidden name="print" value="kas">
                            <div class="row">
                                <div class="col-lg mb-4">
                                    <label for="tanggal_awal" class="mb-2">Tanggal Awal <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Date</span>
                                        <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control <?= error("tanggal_awal") ?>" value="<?= old("tanggal_awal") ?>">
                                        <?php errorMessage("tanggal_awal") ?>
                                    </div>
                                </div>
                                <div class="col-lg mb-4">
                                    <label for="tanggal_akhir" class="mb-2">Tanggal Akhir <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Date</span>
                                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control <?= error("tanggal_akhir") ?>" value="<?= old("tanggal_akhir") ?>">
                                        <?php errorMessage("tanggal_akhir") ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg mb-4">
                                    <label for="tipe_kas" class="mb-2">Tipe Kas</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Text</span>
                                        <select class="form-select" id="tipe_kas" name="tipe_kas">
                                            <option value="" selected>Pilih Tipe Kas</option>
                                            <option value="pemasukan" <?= old("tipe_kas") == "pemasukan" ? "selected" : "" ?>>Pemasukan</option>
                                            <option value="pengeluaran" <?= old("tipe_kas") == "pengeluaran" ? "selected" : "" ?>>Pengeluaran</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-auto ms-auto">
                                    <button type="reset" class="btn px-4">Reset</button>
                                    <button type="submit" class="btn btn-primary px-4">Cetak</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once VIEW_PATH . "layouts/footer.php" ?>