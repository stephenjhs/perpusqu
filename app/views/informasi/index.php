<?php

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/informasi'>Informasi</a></li>
";

$informasi = first("informasi");

$title = "Informasi Perpustakaan";
$subtitle = "Kelola data informasi di halaman ini sesuai keperluan.";

require_once VIEW_PATH . "layouts/header.php";

?>

<?php alertMessage() ?>
<section class="section mb-4">
   <div class="card">
        <div class="card-header pb-2 d-flex justify-content-between align-items-center">
            <p class="mb-0">
                Data Perpustakaan
            </p>
            <?php if(isAdmin()) : ?>
                <a href="/informasi/edit" class="btn btn-warning text-black px-4">Edit Informasi</a>
            <?php endif ?>
        </div>
        <hr class="mx-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg">
                    <ul class="list-group">
                        <li class="list-group-item d-flex">
                            <div class="col-lg" style="max-width: 250px;">Nama Perpustakaan</div>
                            <div><b><?= $informasi->nama_perpustakaan ?></b></div>
                        </li>
                        <li class="list-group-item d-flex">
                            <div class="col-lg" style="max-width: 250px;">Alamat</div>
                            <div><b><?= $informasi->alamat ?></b></div>
                        </li>
                        <li class="list-group-item d-flex">
                            <div class="col-lg" style="max-width: 250px;">Website</div>
                            <a href="<?= $informasi->website ?>" target="_blank"><b><?= $informasi->website ?></b></a>
                        </li>
                        <li class="list-group-item d-flex">
                            <div class="col-lg" style="max-width: 250px;">Email</div>
                            <a href="mailto:<?= $informasi->email ?>"><b><?= $informasi->email ?></b></a>
                        </li>
                        <li class="list-group-item d-flex">
                            <div class="col-lg" style="max-width: 250px;">Tentang</div>
                            <div><b><?= $informasi->tentang ?></b></div>
                        </li>
                        <li class="list-group-item d-flex">
                            <div class="col-lg" style="max-width: 250px;">Jumlah Anggota</div>
                            <div><b><?= amount("anggota") ?> orang</b></div>
                        </li>
                        <li class="list-group-item d-flex">
                            <div class="col-lg" style="max-width: 250px;">Jumlah Buku</div>
                            <div><b><?= sum("buku", "jumlah_buku") ?> buah</b></div>
                        </li>
                        <li class="list-group-item d-flex">
                            <div class="col-lg" style="max-width: 250px;">Jumlah Petugas</div>
                            <div><b><?= amount("pengguna") ?> orang</b></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
   </div>
</section>

<?php require_once VIEW_PATH . "layouts/footer.php" ?>