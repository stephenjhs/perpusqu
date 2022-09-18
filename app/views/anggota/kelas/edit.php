<?php

$sub_path = "/anggota/kelas";
$id = $_GET["id"];

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/anggota'>Anggota</a></li>
    <li class='breadcrumb-item'><a href='/anggota/kelas'>Kelas</a></li>
    <li class='breadcrumb-item'><a href='/anggota/kelas/edit?id=$id'>Edit Data</a></li>
";

$title = "Data Kelas";
$subtitle = "Kelola data kelas di halaman ini sesuai keperluan.";

$kelas = get("kelas_anggota", $id);

if (is_null($kelas)) {
    return require_once VIEW_PATH . "error/404.php";
}

require_once VIEW_PATH . "layouts/header.php";
?>

<?php alertMessage() ?>
<section class="section mb-4">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-2 d-flex justify-content-between align-items-center">
                    <p class="mb-0">
                        Form Edit Data
                    </p>
                    <div class="badge bg-light-success">
                        <?= codeKelas($id) ?>
                    </div>
                </div>
                <hr class="mx-4">
                <div class="card-body">
                    <form action="/anggota/kelas/update" method="POST">
                        <input hidden name="id" value="<?= $kelas->id ?>">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="nama_kelas" class="mb-2">Nama Kelas <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Text</span>
                                    <input name="nama_kelas" id="nama_kelas" class="form-control <?= error("nama_kelas") ?>" placeholder="Masukkan nama kelas..." value="<?= old("nama_kelas", $kelas->nama_kelas) ?>">
                                    <?php errorMessage("nama_kelas") ?>
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
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-2 d-flex justify-content-between align-items-center">
                    <p class="mb-0">
                        Tabel Data
                    </p>
                    <div class="badge bg-info text-black">
                        <?= amount("kelas_anggota") ?> unit
                    </div>
                </div>
                <hr class="mx-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>Nama Kelas</th>
                                    <th>Jumlah Anggota</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (all("kelas_anggota") as $kelas) : ?>
                                    <tr class="text-nowrap">
                                        <td><?= $kelas->nama_kelas ?></td>
                                        <td><?= amountWhere("anggota", "kelas_id", $kelas->id) ?> orang</td>
                                        <td>
                                            <a href="/anggota/kelas/edit?id=<?= $kelas->id ?>" class="badge bg-warning text-black me-1">Edit</a>
                                            <a href="#" class="badge bg-<?= kelasRelational($kelas->id) ? "secondary" : "danger" ?> text-white me-1" data-bs-toggle="modal" data-bs-target="#hapus<?= $kelas->id ?>">Hapus</a>
                                        </td>
                                        <div class="modal fade text-left" id="hapus<?= $kelas->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger py-2">
                                                        <h5 class="modal-title white" id="myModalLabel120">Hapus kelas
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin ingin menghapus <b><?= $kelas->nama_kelas ?></b>? Data yang sudah dihapus tidak dapat dikembalikan!
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="/anggota/kelas/delete" method="POST">
                                                            <input hidden name="id" value="<?= $kelas->id ?>">
                                                            <button type="submit" class="btn btn-danger px-4" data-bs-dismiss="modal">
                                                                <span class="d-block">Hapus</span>
                                                            </button>
                                                        </form>
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
        </div>
    </div>
</section>

<?php require_once VIEW_PATH . "layouts/footer.php" ?>