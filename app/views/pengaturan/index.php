<?php

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/pengaturan'>Pengaturan</a></li>
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
                    <?php if(isAdmin()) : ?>
                        <li class="list-group-item d-flex">
                            <div class="col-lg" style="max-width: 250px">Hapus Gambar</div>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#hapusgambar" class="badge bg-danger text-white">Hapus</a>
                        </li>
                    <?php endif ?>
                    <li class="list-group-item d-flex">
                        <div class="col-lg" style="max-width: 250px">Darkmode</div>
                        <div class="form-check form-switch fs-6">
                            <input class="form-check-input me-0" type="checkbox" id="toggle-dark">
                            <label class="form-check-label"></label>
                        </div>
                    </li>
                    <li class="list-group-item d-flex">
                        <div class="col-lg" style="max-width: 250px">Notifikasi</div>
                            <a href="/pengaturan/notifikasi" class="badge bg-info text-black"><?= amount("notifikasi") ?> pemberitahuan</a>
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

<div class="modal fade text-left" id="hapusgambar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger py-2">
                <h5 class="modal-title white" id="myModalLabel120">Hapus semua gambar
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body p-4">
              <form action="/pengaturan/hapusgambar" method="POST">
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label class="mb-2" for="konfirmasi">Konfirmasi <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Text</span>
                                <input name="konfirmasi" id="konfirmasi" class="form-control" placeholder='Ketik "KONFIRMASI" untuk melanjutkan.'>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto ms-auto">
                            <button type="submit" class="btn btn-danger px-4">Hapus</button>
                        </div>
                    </div>
              </form>
            </div>
        </div>
    </div>
</div>

<?php require_once VIEW_PATH . "layouts/footer.php" ?>