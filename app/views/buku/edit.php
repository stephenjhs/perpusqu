<?php

$sub_path = "/buku";

$id = $_GET["id"];

$title = "Edit Data Buku";
$subtitle = "Halaman ini digunakan untuk mengedit data buku.";

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/buku'>Buku</a></li>
    <li class='breadcrumb-item'><a href='/buku/edit?id=$id'>Edit Data</a></li>
";

$buku = get("buku", $id);

if (is_null($buku)) {
    return require_once VIEW_PATH . "error/404.php";
}

require_once VIEW_PATH . "layouts/header.php";
?>

<?php alertMessage() ?>
<section class="section mb-4">
    <div class="card">
        <div class="card-header pb-2 d-flex justify-content-between align-items-center">
            <p class="mb-0">
                Form Edit Data
            </p>
            <div class="d-flex">
                <div class="badge bg-light-success">
                    <?= codeBuku($buku->id) ?>
                </div>
            </div>
        </div>
        <hr class="mx-4">
        <div class="card-content">
            <div class="card-body">
                <form action="/buku/update" method="POST" enctype="multipart/form-data">
                    <input hidden name="id" value="<?= $buku->id ?>">
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label class="mb-2">Dibuat Pada</label>
                            <div class="input-group">
                                <input readonly value="<?= timeago("@" . $buku->dibuat_pada) ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label class="mb-2">Terakhir Diedit</label>
                            <div class="input-group">
                                <input readonly value="<?= timeago("@" . $buku->diedit_pada) ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label for="isbn" class="mb-2">ISBN <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">#</span>
                                <input name="isbn" id="isbn" class="form-control <?= error("isbn") ?>" placeholder="Masukkan isbn..." value="<?= old("isbn", $buku->isbn) ?>">
                                <?php errorMessage("isbn") ?>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label for="judul" class="mb-2">Judul <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Text</span>
                                <input name="judul" id="judul" class="form-control <?= error("judul") ?>" placeholder="Masukkan judul..." value="<?= old("judul", $buku->judul) ?>">
                                <?php errorMessage("judul") ?>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label for="pengarang" class="mb-2">Pengarang <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Text</span>
                                <input name="pengarang" id="pengarang" class="form-control <?= error("pengarang") ?>" placeholder="Masukkan pengarang..." value="<?= old("pengarang", $buku->pengarang) ?>">
                                <?php errorMessage("pengarang") ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label for="penerbit" class="mb-2">Penerbit <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Text</span>
                                <input name="penerbit" id="penerbit" class="form-control <?= error("penerbit") ?>" placeholder="Masukkan penerbit..." value="<?= old("penerbit", $buku->penerbit) ?>">
                                <?php errorMessage("penerbit") ?>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label for="tahun_terbit" class="mb-2">Tahun Terbit <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">#</span>
                                <input type="number" name="tahun_terbit" id="tahun_terbit" class="form-control <?= error("tahun_terbit") ?>" placeholder="Masukkan tahun terbit..." value="<?= old("tahun_terbit", $buku->tahun_terbit) ?>">
                                <?php errorMessage("tahun_terbit") ?>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label for="jumlah_buku" class="mb-2">Jumlah Buku <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">#</span>
                                <input type="number" name="jumlah_buku" id="jumlah_buku" class="form-control <?= error("jumlah_buku") ?>" placeholder="Masukkan jumlah buku..." value="<?= old("jumlah_buku", $buku->jumlah_buku) ?>">
                                <?php errorMessage("jumlah_buku") ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label for="kategori" class="mb-2">Kategori <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Text</span>
                                <select class="form-select <?= error("kategori_id") ?>" id="kategori" name="kategori_id">
                                    <option value="" selected>Pilih Kategori</option>
                                    <?php foreach (all("kategori_buku") as $kategori) : ?>
                                        <option value="<?= $kategori->id ?>" <?= old("kategori_id", $buku->kategori_id) == $kategori->id ? "selected" : "" ?>><?= $kategori->nama_kategori ?></option>
                                    <?php endforeach ?>
                                </select>
                                <?php errorMessage("kategori_id") ?>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label for="lokasi" class="mb-2">Lokasi <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Text</span>
                                <select class="form-select <?= error("lokasi_id") ?>" id="lokasi" name="lokasi_id">
                                    <option value="" selected>Pilih Lokasi</option>
                                    <?php foreach (all("lokasi_buku") as $lokasi) : ?>
                                        <option value="<?= $lokasi->id ?>" <?= old("lokasi_id", $buku->lokasi_id) == $lokasi->id ? "selected" : "" ?>><?= $lokasi->nama_lokasi ?></option>
                                    <?php endforeach ?>
                                </select>
                                <?php errorMessage("lokasi_id") ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label for="total_halaman" class="mb-2">Total Halaman <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">#</span>
                                <input type="number" name="total_halaman" id="total_halaman" class="form-control <?= error("total_halaman") ?>" placeholder="Masukkan total halaman..." value="<?= old("total_halaman", $buku->total_halaman) ?>">
                                <?php errorMessage("total_halaman") ?>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label for="harga" class="mb-2">Harga <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">#</span>
                                <input type="number" name="harga" id="harga" class="form-control <?= error("harga") ?>" placeholder="Masukkan harga..." value="<?= old("harga", $buku->harga) ?>">
                                <?php errorMessage("harga") ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label for="keterangan" class="mb-2">Keterangan</label>
                            <div class="form-group ">
                                <textarea class="form-control <?= error("keterangan") ?>" name="keterangan" id="keterangan" style="height: 150px;" placeholder="Masukkan keterangan..."><?= old("keterangan", $buku->keterangan) ?></textarea>
                                <?php errorMessage("keterangan") ?>
                            </div>
                        </div>
                        <div class="col-lg mb-4 mt-4">
                            <img src="/images/<?= $buku->sampul ?>" class="image-preview" alt="">
                        </div>
                        <div class="col-lg mb-4">
                            <label for="sampul" class="mb-2">Sampul</label>
                            <div class="form-group">
                                <input name="sampul" type="file" id="sampul" class="form-control" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto ms-auto">
                            <button type="reset" class="btn px-4">Reset</button>
                            <button type="submit" class="btn btn-primary px-4">Ubah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once VIEW_PATH . "layouts/footer.php" ?>