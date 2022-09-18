<?php

$sub_path = "/anggota";

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/anggota'>Anggota</a></li>
    <li class='breadcrumb-item'><a href='/anggota/create'>Tambah Data</a></li>
";

$title = "Tambah Data Anggota";
$subtitle = "Halaman ini digunakan untuk menambah data anggota.";

require_once VIEW_PATH . "layouts/header.php";
?>

<?php alertMessage() ?>
<section class="section mb-4">
    <div class="card">
        <div class="card-header pb-2 d-flex justify-content-between align-items-center">
            <p class="mb-0">
                Form Tambah Data
            </p>
            <div class="badge bg-light-success">
                <?= codeAnggota() ?>
            </div>
        </div>
        <hr class="mx-4">
        <div class="card-content">
            <div class="card-body">
                <form action="/anggota/store" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label for="nis" class="mb-2">NIS <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">#</span>
                                <input type="number" name="nis" id="nis" class="form-control <?= error("nis") ?>" placeholder="Masukkan nis..." value="<?= old("nis") ?>">
                                <?php errorMessage("nis") ?>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label for="nama" class="mb-2">Nama <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Text</span>
                                <input name="nama" id="nama" class="form-control <?= error("nama") ?>" placeholder="Masukkan nama..." value="<?= old("nama") ?>">
                                <?php errorMessage("nama") ?>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label for="tanggal_lahir" class="mb-2">Tanggal Lahir <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Date</span>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control <?= error("tanggal_lahir") ?>" value="<?= old("tanggal_lahir") ?>">
                                <?php errorMessage("tanggal_lahir") ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label for="username" class="mb-2">Username <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">#</span>
                                <input name="username" id="username" class="form-control <?= error("username") ?>" placeholder="Masukkan username..." value="<?= old("username") ?>">
                                <?php errorMessage("username") ?>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label for="password" class="mb-2">Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Secret</span>
                                <input type="password" name="password" id="password" class="form-control <?= error("password") ?>" placeholder="Masukkan password..." value="<?= old("password") ?>">
                                <?php errorMessage("password") ?>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label for="password_confirmation" class="mb-2">Konfirmasi Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Secret</span>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control <?= error("password_confirmation") ?>" placeholder="Masukkan konfirmasi password..." value="<?= old("password_confirmation") ?>">
                                <?php errorMessage("password_confirmation") ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label for="jenis_kelamin" class="mb-2">Jenis Kelamin <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Text</span>
                                <select class="form-select <?= error("jenis_kelamin") ?>" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="" selected>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" <?= old("jenis_kelamin") == "Laki-laki" ? "selected" : "" ?>>Laki-laki</option>
                                    <option value="Perempuan" <?= old("jenis_kelamin") == "Perempuan" ? "selected" : "" ?>>Perempuan</option>
                                </select>
                                <?php errorMessage("jenis_kelamin") ?>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label for="telepon" class="mb-2">Telepon <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Text</span>
                                <input name="telepon" id="telepon" class="form-control <?= error("telepon") ?>" placeholder="Masukkan telepon..." value="<?= old("telepon") ?>">
                                <?php errorMessage("telepon") ?>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label for="kelas" class="mb-2">Kelas <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Text</span>
                                <select class="form-select <?= error("kelas_id") ?>" id="kelas" name="kelas_id">
                                    <option value="" selected>Pilih Kelas</option>
                                    <?php foreach (all("kelas_anggota") as $kelas) : ?>
                                        <option value="<?= $kelas->id ?>" <?= old("kelas_id") == $kelas->id ? "selected" : "" ?>><?= $kelas->nama_kelas ?></option>
                                    <?php endforeach ?>
                                </select>
                                <?php errorMessage("kelas_id") ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label for="alamat" class="mb-2">Alamat <span class="text-danger">*</span></label>
                            <div class="form-group ">
                                <textarea class="form-control <?= error("alamat") ?>" name="alamat" id="alamat" style="height: 150px;" placeholder="Masukkan alamat..."><?= old("alamat") ?></textarea>
                                <?php errorMessage("alamat") ?>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label for="gambar" class="mb-2">Gambar</label>
                            <div class="form-group">
                                <input name="gambar" type="file" id="gambar" class="form-control" accept="image/*">
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
</section>

<?php require_once VIEW_PATH . "layouts/footer.php" ?>