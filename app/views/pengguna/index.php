<?php

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/pengguna'>Pengguna</a></li>
";

$title = "Data Pengguna";
$subtitle = "Kelola data pengguna di halaman ini sesuai keperluan.";

require_once VIEW_PATH . "layouts/header.php";

?>

<link rel='stylesheet' href='/mazer/css/pages/simple-datatables.css'>
<?php alertMessage() ?>
<section class="section mb-4">
    <div class="card">
        <div class="card-header pb-2 d-flex justify-content-between align-items-center">
            <p class="mb-0">
                Tabel Data
            </p>
            <?php if(isAdmin()) : ?>
                <a href="/pengguna/create" class="btn btn-primary px-4">Tambah Data</a>
            <?php endif ?>
        </div>
        <hr class="mx-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr class="text-nowrap">
                            <th>ID</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Dibuat Pada</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (all("pengguna") as $pengguna) : ?>
                            <tr class="text-nowrap">
                                <td><?= codePengguna($pengguna->id) ?></td>
                                <td><?= $pengguna->username ?></td>
                                <td><?= $pengguna->nama ?></td>
                                <td><?= $pengguna->role ?></td>
                                <td><?= timeago("@" . $pengguna->dibuat_pada) ?></td>
                                <td>    
                                    <a href="#" class="badge bg-info text-black me-1" data-bs-toggle="modal" data-bs-target="#detail<?= $pengguna->id ?>">Detail</a>
                                    <?php if(isAdmin()) : ?>
                                        <a href="/pengguna/edit?id=<?= $pengguna->id ?>" class="badge bg-warning text-black me-1">Edit</a>
                                        <a href="#" class="badge bg-<?= penggunaRelational($pengguna->id) ? "secondary" : "danger" ?> text-white me-1" data-bs-toggle="modal" data-bs-target="#hapus<?= $pengguna->id ?>">Hapus</a>
                                    <?php elseif($pengguna->id == auth()->id) : ?>
                                        <a href="/pengguna/edit?id=<?= $pengguna->id ?>" class="badge bg-warning text-black me-1">Edit</a>
                                    <?php endif ?>
                                </td>
                                <?php if(isAdmin()) : ?>
                                    <div class="modal fade text-left" id="hapus<?= $pengguna->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger py-2">
                                                    <h5 class="modal-title white" id="myModalLabel120">Hapus pengguna
                                                    </h5>
                                                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin menghapus <b><?= $pengguna->nama ?></b>? Data yang sudah dihapus tidak dapat dikembalikan!
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="/pengguna/delete" method="POST">
                                                        <input hidden name="id" value="<?= $pengguna->id ?>">
                                                        <button type="submit" class="btn btn-danger px-4" data-bs-dismiss="modal">
                                                            <span class="d-block">Hapus</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <div class="modal fade text-left" id="detail<?= $pengguna->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary py-2">
                                                <h5 class="modal-title white" id="myModalLabel120">Detail pengguna
                                                </h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="row">
                                                    <div class="col-lg-3 -me-2">
                                                        <img src="/images/profil/<?= $pengguna->role ?>.jpg" class="image-detail" alt="">
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <ul class="list-group">
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">ID</div>
                                                                <div class="badge bg-success"><?= codePengguna($pengguna->id) ?></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Username</div>
                                                                <div><b><?= $pengguna->username ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Nama</div>
                                                                <div><b><?= $pengguna->nama ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Alamat</div>
                                                                <div><b><?= $pengguna->alamat ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Jenis Kelamin</div>
                                                                <div><b><?= $pengguna->jenis_kelamin ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Telepon</div>
                                                                <div><b><?= $pengguna->telepon ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Role</div>
                                                                <div><b><?= $pengguna->role ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Dibuat Pada</div>
                                                                <div><b><?= timeago("@" . $pengguna->dibuat_pada) ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Terakhir Diedit</div>
                                                                <div><b><?= timeago("@" . $pengguna->diedit_pada) ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Anggota Dilayani</div>
                                                                <div>
                                                                    <b><?= amountWhere("peminjaman", "pengguna_id", $pengguna->id) ?> orang</b>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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