<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$sub_path = "/transaksi/denda";

$styles = "
    <link rel='stylesheet' href='/mazer/css/pages/simple-datatables.css'>
";

$scripts = "
    <script src='/mazer/js/extensions/simple-datatables.js'></script>
";

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/transaksi'>Transaksi</a></li>
    <li class='breadcrumb-item'><a href='/transaksi/denda'>Denda</a></li>
";

$title = "Data Denda";
$subtitle = "Berisi informasi lengkap tentang denda.";

require_once VIEW_PATH . "layouts/header.php";
?>

<?php alertMessage() ?>
<section class="section mb-4">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-3 d-flex justify-content-between align-items-center">
                    <p class="mb-0">
                        Besaran Denda
                    </p>
                    <a href="#" class="badge bg-warning text-black" data-bs-toggle="modal" data-bs-target="#edit">Edit</a>
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
                   <h4 class="mb-0"><?= rp(sum("peminjaman", "denda_dibayarkan")) ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-3">
                    <p class="mb-0">
                        Jumlah Orang Bayar Denda
                    </p>
                </div>
                <div class="card-body">
                   <h4 class="mb-0"><?= Capsule::table("peminjaman")->whereRaw("denda_dibayarkan > 0")->count("denda_dibayarkan") ?> orang</h3>
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
                        <?php foreach (allWhere("peminjaman", "status", 1) as $peminjaman) : ?>
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

<div class="modal fade text-left" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary py-2">
                <h5 class="modal-title white" id="myModalLabel120">Edit besaran denda
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body p-4">
              <form action="/transaksi/denda/update" method="POST">
                    <input hidden name="id" value="<?= first("denda")->id ?>">
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label class="mb-2" for="besaran_denda">Besaran Denda <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">#</span>
                                <input type="number" name="besaran_denda" id="besaran_denda" class="form-control" value="<?= first("denda")->besaran_denda ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto ms-auto">
                            <button type="submit" class="btn btn-primary px-4">Ubah</button>
                        </div>
                    </div>
              </form>
            </div>
        </div>
    </div>
</div>

<?php require_once VIEW_PATH . "layouts/footer.php" ?>