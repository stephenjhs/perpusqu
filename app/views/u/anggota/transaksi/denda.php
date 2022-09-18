<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$sub_path = "/transaksi/denda";

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/u/anggota/transaksi'>Transaksi</a></li>
    <li class='breadcrumb-item'><a href='/u/anggota/transaksi/denda'>Denda</a></li>
";

$title = "Data Denda Anda";
$subtitle = "Berisi informasi lengkap tentang denda anda.";

require_once VIEW_PATH . "layouts/header.php";
?>

<link rel='stylesheet' href='/mazer/css/pages/simple-datatables.css'>
<?php alertMessage() ?>
<section class="section mb-4">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-3">
                    <p class="mb-0">
                        Besaran Denda
                    </p>
                </div>
                <div class="card-body">
                   <h4 class="mb-0"><?= rp(first("denda")->besaran_denda) ?> / hari</h3>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-3">
                    <p class="mb-0">
                        Total Denda Dibayarkan
                    </p>
                </div>
                <div class="card-body">
                   <h4 class="mb-0"><?= rp(sumWhere("peminjaman", "anggota_id", auth()->id, "denda_dibayarkan")) ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-3">
                    <p class="mb-0">
                        Jumlah Anda Membayar Denda
                    </p>
                </div>
                <div class="card-body">
                   <h4 class="mb-0"><?= Capsule::table("peminjaman")->where("anggota_id", auth()->id)->whereRaw("denda_dibayarkan > 0")->count("denda_dibayarkan") ?> kali</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header pb-2">
            <p class="mb-0">
                Transaksi Denda Dibayarkan
            </p>
        </div>
        <hr class="mx-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr class="text-nowrap">
                            <th>ID</th>
                            <th>Nama Peminjam</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Batas Pengembalian</th>
                            <th>Denda</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (Capsule::table("peminjaman")->where("anggota_id", auth()->id)->where("status", 1)->get() as $peminjaman) : ?>
                            <?php if($peminjaman->denda_dibayarkan > 0) : ?>
                                <tr class="text-nowrap">
                                    <td><?= codePeminjaman($peminjaman->id) ?></td>
                                    <td><?= get("anggota", $peminjaman->anggota_id)->nama ?></td>
                                    <td><?= $peminjaman->tanggal_peminjaman ?></td>
                                    <td><?= $peminjaman->batas_pengembalian ?></td>
                                    <td><?= denda($peminjaman->id) ?></td>
                                    <td>
                                        <div class="badge bg-success">Sudah kembali</div>
                                    </td>
                                </tr>
                            <?php endif ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script src='/mazer/js/extensions/simple-datatables.js'></script>

<?php require_once VIEW_PATH . "layouts/footer.php" ?>