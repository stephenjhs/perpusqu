<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$sub_path = "/pengaturan";

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/pengaturan'>Pengaturan</a></li>
    <li class='breadcrumb-item'><a href='/pengaturan/notifikasi'>Notifikasi</a></li>
";

$title = "Data Notifikasi";
$subtitle = "Halaman ini berisi semua notifikasi.";

require_once VIEW_PATH . "layouts/header.php";

?>

<link rel='stylesheet' href='/mazer/css/pages/simple-datatables.css'>
<section class="section mb-4">
    <div class="card">
        <div class="card-header pb-2 d-flex justify-content-between align-items-center">
            <p class="mb-0">
                Tabel Data
            </p>
        </div>
        <hr class="mx-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr class="text-nowrap">
                            <th>#</th>
                            <th>Isi Notifikasi</th>
                            <th>Dibuat Pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (all("notifikasi") as $key => $notifikasi) : ?>
                            <tr class="text-nowrap">
                                <td><?= $key + 1 ?></td>
                                <td><?= $notifikasi->isi_notifikasi ?></td>
                                <td><?= timeago("@" . $notifikasi->dibuat_pada) ?></td>
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