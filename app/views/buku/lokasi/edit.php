<?php

$sub_path = "/buku/lokasi";
$id = $_GET["id"];

$title = "Data Lokasi";
$subtitle = "Kelola data lokasi di halaman ini sesuai keperluan.";

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/buku'>Buku</a></li>
    <li class='breadcrumb-item'><a href='/buku/lokasi'>Lokasi</a></li>
    <li class='breadcrumb-item'><a href='/buku/lokasi/edit?id=$id'>Edit Data</a></li>
";

$lokasi = get("lokasi_buku", $id);

if (is_null($lokasi)) {
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
                        <?= codeLokasi($id) ?>
                    </div>
                </div>
                <hr class="mx-4">
                <div class="card-body">
                    <form action="/buku/lokasi/update" method="POST">
                        <input hidden name="id" value="<?= $lokasi->id ?>">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="nama_lokasi" class="mb-2">Nama Lokasi <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Text</span>
                                    <input name="nama_lokasi" id="nama_lokasi" class="form-control <?= error("nama_lokasi") ?>" placeholder="Masukkan nama lokasi..." value="<?= old("nama_lokasi", $lokasi->nama_lokasi) ?>">
                                    <?php errorMessage("nama_lokasi") ?>
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
                        <?= amount("lokasi_buku") ?> unit
                    </div>
                </div>
                <hr class="mx-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>Nama Lokasi</th>
                                    <th>Jumlah Buku</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (all("lokasi_buku") as $lokasi) : ?>
                                    <tr class="text-nowrap">
                                        <td><?= $lokasi->nama_lokasi ?></td>
                                        <td><?= amountWhere("buku", "lokasi_id", $lokasi->id) ?> buah</td>
                                        <td>
                                            <a href="/buku/lokasi/edit?id=<?= $lokasi->id ?>" class="badge bg-warning text-black me-1">Edit</a>
                                            <a href="#" class="badge bg-<?= lokasiRelational($lokasi->id) ? "secondary" : "danger" ?> text-white me-1" data-bs-toggle="modal" data-bs-target="#hapus<?= $lokasi->id ?>">Hapus</a>
                                        </td>
                                        <div class="modal fade text-left" id="hapus<?= $lokasi->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger py-2">
                                                        <h5 class="modal-title white" id="myModalLabel120">Hapus lokasi
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin ingin menghapus <b><?= $lokasi->nama_lokasi ?></b>? Data yang sudah dihapus tidak dapat dikembalikan!
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="/buku/lokasi/delete" method="POST">
                                                            <input hidden name="id" value="<?= $lokasi->id ?>">
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