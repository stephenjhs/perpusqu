<?php

$sub_path = "/profil/catatan";

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/profil'>Profil</a></li>
    <li class='breadcrumb-item'><a href='/profil/catatan'>Catatan</a></li>
";

$title = "Catatan Anda";
$subtitle = "Semua catatanmu akan ditampilkan di halaman ini.";

require_once VIEW_PATH . "layouts/header.php";

?>

<?php alertMessage() ?>
<section class="section mb-4">
    <div class="card">
        <div class="card-header pb-2 d-flex justify-content-between align-items-center">
            <p class="mb-0">
                Data Catatan
            </p>
            <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary px-4">Tambah Catatan</a>
        </div>
        <hr class="mx-4">
        <div class="card-body">
            <div class="row">
                <?php if(amountWhere("catatan_pengguna", "pengguna_id", auth()->id) == 0) : ?>
                    <div class="text-center">Data tidak ada</div>
                <?php endif ?>
                <?php foreach(allWhere("catatan_pengguna", "pengguna_id", auth()->id) as $catatan) : ?>
                    <div class="col-lg-12 mb-4">
                        <div class="text-white p-2" style="background: #151521;">
                            <div class="card-body">
                                <div><?= $catatan->isi_catatan ?></div>
                                <hr>
                                <div class="text-sm d-flex align-items-center justify-content-between">
                                    <div>
                                        <?= timeago("@" . $catatan->dibuat_pada) ?>
                                    </div>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#hapus<?= $catatan->id ?>" class="text-danger">Hapus</a>
                                </div>
                            </div>
                            <div class="modal fade text-left" id="hapus<?= $catatan->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger py-2">
                                            <h5 class="modal-title white" id="myModalLabel120">Hapus catatan
                                            </h5>
                                             <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah anda yakin ingin menghapus catatan ini? Data yang sudah dihapus tidak dapat dikembalikan!
                                        </div>
                                        <div class="modal-footer">
                                            <form action="/profil/catatan/delete" method="POST">
                                                <input hidden name="id" value="<?= $catatan->id ?>">
                                                <button type="submit" class="btn btn-danger px-4" data-bs-dismiss="modal">
                                                    <span class="d-block">Hapus</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    
</section>

<div class="modal fade text-left" id="tambah<?= $peminjaman->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary py-2">
                <h5 class="modal-title white" id="myModalLabel120">Tambah catatan
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body p-4">
              <form action="/profil/catatan/store" method="POST">
                    <div class="row">
                       <div class="col-lg mb-4">
                            <label for="isi_catatan" class="mb-2">Isi Catatan <span class="text-danger">*</span></label>
                            <div class="form-group ">
                                <textarea class="form-control" name="isi_catatan" id="isi_catatan" style="height: 150px;" placeholder="Masukkan isi catatan..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto ms-auto">
                            <button type="reset" class="btn px-4">Reset</button>
                            <button type="submit" class="btn btn-primary px-4">Tambah</button>
                        </div>
                    </div>
              </form>
            </div>
        </div>
    </div>
</div>

<?php require_once VIEW_PATH . "layouts/footer.php" ?>