<?php

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/u/anggota/pengaturan'>Pengaturan</a></li>
";

$title = "Pengaturan";
$subtitle = "Gunakan halaman ini untuk mengatur reset atau init aplikasi.";

require_once VIEW_PATH . "layouts/header.php";

?>

<?php alertMessage() ?>
<section class="section mb-4">
   <div class="card">
        <div class="card-header pb-2 d-flex justify-content-between align-items-center">
            <p class="mb-0">
                Data Pengaturan
            </p>
        </div>
        <hr class="mx-4">
        <div class="card-body">
          <div class="row">
            <div class="col-lg">
                <ul class="list-group">
                    <li class="list-group-item d-flex">
                        <div class="col-lg" style="max-width: 250px">Darkmode</div>
                        <div class="form-check form-switch fs-6">
                            <input class="form-check-input me-0" type="checkbox" id="toggle-dark">
                            <label class="form-check-label"></label>
                        </div>
                    </li>
                    <li class="list-group-item d-flex">
                        <div class="col-lg" style="max-width: 250px">Keluar</div>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#keluar" class="badge bg-primary text-white">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        </div>
   </div>
</section>

<?php require_once VIEW_PATH . "layouts/footer.php" ?>