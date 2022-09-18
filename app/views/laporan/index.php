<?php

$sub_path = "/laporan";

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/transaksi'>Laporan</a></li>
";

$title = "Data Laporan";
$subtitle = "Berisi informasi lengkap tentang laporan.";

require_once VIEW_PATH . "layouts/header.php";
?>

<?php alertMessage() ?>
<section class="section mb-4">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-3 d-flex justify-content-between align-items-center">
                    <p class="mb-0">
                        Laporan Anggota
                    </p>
                    <a href="/laporan/anggota" class="badge bg-info text-black">Lihat</a>
                </div>
                <div class="card-body">
                   <h4 class="mb-0"><?= amount("anggota") ?> orang</h4>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-3 d-flex justify-content-between align-items-center">
                    <p class="mb-0">
                        Laporan Buku
                    </p>
                    <a href="/laporan/buku" class="badge bg-info text-black">Lihat</a>
                </div>
                <div class="card-body">
                   <h4 class="mb-0"><?= sum("buku", "jumlah_buku") ?> buah</h4>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-3 d-flex justify-content-between align-items-center">
                    <p class="mb-0">
                        Laporan Peminjaman
                    </p>
                    <a href="/laporan/peminjaman" class="badge bg-info text-black">Lihat</a>
                </div>
                <div class="card-body">
                   <h4 class="mb-0"><?= amount("peminjaman") ?> kali</h4>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-3 d-flex justify-content-between align-items-center">
                    <p class="mb-0">
                        Laporan Pengguna
                    </p>
                    <a href="/laporan/pengguna" class="badge bg-info text-black">Lihat</a>
                </div>
                <div class="card-body">
                   <h4 class="mb-0"><?= amount("pengguna") ?> orang</h4>
                </div>
            </div>
        </div>
    </div>

</section>

<?php require_once VIEW_PATH . "layouts/footer.php" ?>