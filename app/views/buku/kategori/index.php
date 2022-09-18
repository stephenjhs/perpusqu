<?php

$sub_path = "/buku/kategori";

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/buku'>Buku</a></li>
    <li class='breadcrumb-item'><a href='/buku/kategori'>Kategori</a></li>
";

$title = "Data Kategori";
$subtitle = "Kelola data kategori di halaman ini sesuai keperluan.";

require_once VIEW_PATH . "layouts/header.php";
?>

<?php alertMessage() ?>
<section class="section mb-4">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-2 d-flex justify-content-between align-items-center">
                    <p class="mb-0">
                        Form Tambah Data
                    </p>
                    <div class="badge bg-light-success">
                        <?= codeKategori() ?>
                    </div>
                </div>
                <hr class="mx-4">
                <div class="card-body">
                    <form action="/buku/kategori/store" method="POST">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="nama_kategori" class="mb-2">Nama Kategori <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Text</span>
                                    <input name="nama_kategori" id="nama_kategori" class="form-control <?= error("nama_kategori") ?>" placeholder="Masukkan nama kategori..." value="<?= old("nama_kategori") ?>">
                                    <?php errorMessage("nama_kategori") ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-auto ms-auto">
                                <button type="submit" class="btn btn-primary px-4">Tambah</button>
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
                        <?= amount("kategori_buku") ?> unit
                    </div>
                </div>
                <hr class="mx-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>Nama Kategori</th>
                                    <th>Jumlah Buku</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(amount("kategori_buku") == 0) : ?>
                                    <tr class="text-nowrap">
                                        <td colspan="100%" style="text-align: center;">Data tidak ada</td>
                                    </tr>
                                <?php endif ?>
                                <?php foreach (all("kategori_buku") as $kategori) : ?>
                                    <tr class="text-nowrap">
                                        <td><?= $kategori->nama_kategori ?></td>
                                        <td><?= amountWhere("buku", "kategori_id", $kategori->id) ?> buah</td>
                                        <td>
                                            <a href="/buku/kategori/edit?id=<?= $kategori->id ?>" class="badge bg-warning text-black me-1">Edit</a>
                                            <a href="#" class="badge bg-<?= kategoriRelational($kategori->id) ? "secondary" : "danger" ?> text-white me-1" data-bs-toggle="modal" data-bs-target="#hapus<?= $kategori->id ?>">Hapus</a>
                                        </td>
                                        <div class="modal fade text-left" id="hapus<?= $kategori->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger py-2">
                                                        <h5 class="modal-title white" id="myModalLabel120">Hapus kategori
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin ingin menghapus <b><?= $kategori->nama_kategori ?></b>? Data yang sudah dihapus tidak dapat dikembalikan!
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="/buku/kategori/delete" method="POST">
                                                            <input hidden name="id" value="<?= $kategori->id ?>">
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