<?php

$sub_path = "/laporan/anggota";

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/laporan'>Laporan</a></li>
    <li class='breadcrumb-item'><a href='/laporan/anggota'>Anggota</a></li>
";

$title = "Data Laporan Anggota";
$subtitle = "Cetak laporan anggota dengan format PDF.";

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
                            Laporan Data Anggota
                        </p>
                        <div class="badge bg-info text-black">
                            <?= amount("anggota") ?> orang
                        </div>
                    </div>
                    <hr class="mx-4">
                    <div class="card-body">
                        <form action="/laporan/anggota/print" method="POST">
                            <input hidden name="print" value="anggota">
                            <div class="row">
                                <div class="col-lg mb-4">
                                    <label for="tanggal_awal" class="mb-2">Tanggal Awal <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Date</span>
                                        <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control <?= error("tanggal_awal") ?>" value="<?= old("tanggal_awal") ?>">
                                        <?php errorMessage("tanggal_awal") ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
        <div class="col-lg">
            <div class="card">
                <div class="card-content">
                    <div class="card-header pb-2 d-flex justify-content-between align-items-center">
                        <p class="mb-0">
                            Laporan Data Kelas
                        </p>
                        <div class="badge bg-info text-black">
                            <?= amount("kelas_anggota") ?> unit
                        </div>
                    </div>
                    <hr class="mx-4">
                    <div class="card-body">
                        <form action="/laporan/anggota/print" method="POST">
                            <input hidden name="print" value="kelas">
                            <div class="row">
                                <div class="col-auto ms-auto">
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