<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$sub_path = "/profil";

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/u/anggota/profil'>Profil</a></li>
";

$title = "Profil Anda";
$subtitle = "Kelola data profil di halaman ini sesuai keperluan.";

require_once VIEW_PATH . "layouts/header.php";

?>

<?php alertMessage() ?>
<section class="section mb-4">
   <div class="card">
        <div class="card-header pb-2 d-flex justify-content-between align-items-center">
            <p class="mb-0">
                Data Profil
            </p>
            <a href="/u/anggota/profil/edit" class="btn btn-warning text-black px-4">Edit Profil</a>
        </div>
        <hr class="mx-4">
        <div class="card-body">
          <div class="row">
            <div class="col-lg -me-2" style="max-width: 280px;">
                <img src="/images/<?= auth()->gambar ?>" class="image-detail" alt="">
            </div>
            <div class="col-lg">
                <ul class="list-group">
                    <li class="list-group-item d-flex">
                        <div class="col-lg" style="max-width: 250px">ID</div>
                        <div class="badge bg-success"><?= codeAnggota(auth()->id) ?></div>
                    </li>
                    <li class="list-group-item d-flex">
                        <div class="col-lg" style="max-width: 250px">NIS</div>
                        <div><b><?= auth()->nis ?></b></div>
                    </li>
                    <li class="list-group-item d-flex">
                        <div class="col-lg" style="max-width: 250px">Username</div>
                        <div><b><?= auth()->username ?></b></div>
                    </li>
                    <li class="list-group-item d-flex">
                        <div class="col-lg" style="max-width: 250px">Nama</div>
                        <div><b><?= auth()->nama ?></b></div>
                    </li>
                    <li class="list-group-item d-flex">
                        <div class="col-lg" style="max-width: 250px">Alamat</div>
                        <div><b><?= auth()->alamat ?></b></div>
                    </li>
                    <li class="list-group-item d-flex">
                        <div class="col-lg" style="max-width: 250px">Telepon</div>
                        <div><b><?= auth()->telepon ?></b></div>
                    </li>
                    <li class="list-group-item d-flex">
                        <div class="col-lg" style="max-width: 250px">Tanggal Lahir</div>
                        <div><b><?= auth()->tanggal_lahir ?></b></div>
                    </li>
                    <li class="list-group-item d-flex">
                        <div class="col-lg" style="max-width: 250px">Jenis Kelamin</div>
                        <div><b><?= auth()->jenis_kelamin ?></b></div>
                    </li>
                    <li class="list-group-item d-flex">
                        <div class="col-lg" style="max-width: 250px">Kelas</div>
                        <div><b><?= get("kelas_anggota", auth()->kelas_id)->nama_kelas ?></b></div>
                    </li>
                    <li class="list-group-item d-flex">
                        <div class="col-lg" style="max-width: 250px">Dibuat Pada</div>
                        <div><b><?= timeago("@" . auth()->dibuat_pada) ?></b></div>
                    </li>
                    <li class="list-group-item d-flex">
                        <div class="col-lg" style="max-width: 250px">Terakhir Diedit</div>
                        <div><b><?= timeago("@" . auth()->diedit_pada) ?></b></div>
                    </li>
                    <li class="list-group-item d-flex">
                        <div class="col-lg" style="max-width: 250px">Buku Dipinjam</div>
                        <div><b><?= Capsule::table("detail_peminjaman")->whereIn("peminjaman_id", pluck("peminjaman", "anggota_id", auth()->id, "id"))->sum("jumlah_buku") ?> buah</b></div>
                    </li>
                    <li class="list-group-item d-flex">
                        <div class="col-lg" style="max-width: 250px">Peminjaman</div>
                        <div><b><?= amountWhere("peminjaman", "anggota_id", auth()->id) ?> kali</b></div>
                    </li>
                    <li class="list-group-item d-flex">
                        <div class="col-lg" style="max-width: 250px">Cetak Kartu</div>
                        <a href="/u/anggota/profil/kartu" class="badge bg-info text-black">Lihat Kartu</a>
                    </li>
                </ul>
            </div>
        </div>
        </div>
   </div>
</section>

<?php require_once VIEW_PATH . "layouts/footer.php" ?>