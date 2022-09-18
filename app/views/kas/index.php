<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/kas'>Kas</a></li>
";

$title = "Data Kas";
$subtitle = "Berisi informasi lengkap tentang kas.";

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
                        Total Kas
                    </p>
                </div>
                <div class="card-body">
                   <h4 class="mb-0"><?= rp(sumWhere("kas", "tipe_kas", "pemasukan", "besaran_kas") - sumWhere("kas", "tipe_kas", "pengeluaran", "besaran_kas")) ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-3">
                    <p class="mb-0">
                        Total Pemasukan
                    </p>
                </div>
                <div class="card-body">
                   <h4 class="mb-0"><?= rp(sumWhere("kas", "tipe_kas", "pemasukan", "besaran_kas")) ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-3">
                    <p class="mb-0">
                        Total Pengeluaran
                    </p>
                </div>
                <div class="card-body">
                   <h4 class="mb-0"><?= rp(sumWhere("kas", "tipe_kas", "pengeluaran", "besaran_kas")) ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header pb-2 d-flex align-items-center justify-content-between">
            <p class="mb-0">
                Tabel Data
            </p>
            <a href="/kas/create" class="btn btn-primary px-4">Tambah Data</a>
        </div>
        <hr class="mx-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr class="text-nowrap">
                            <th>ID</th>
                            <th>Besaran Kas</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th>Tipe Kas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (all("kas") as $kas) : ?>
                            <tr class="text-nowrap">
                                <td><?= codeKas($kas->id) ?></td>
                                <td><?= rp($kas->besaran_kas) ?></td>
                                <td><?= $kas->keterangan ?></td>
                                <td><?= $kas->tanggal ?></td>
                                <td>
                                    <?php if ($kas->tipe_kas == "pemasukan") : ?>
                                        <div class="badge bg-success">Pemasukan</div>
                                    <?php else : ?>
                                        <div class="badge bg-danger">Pengeluaran</div>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script src='/mazer/js/extensions/simple-datatables.js'></script>

<?php require_once VIEW_PATH . "layouts/footer.php" ?>