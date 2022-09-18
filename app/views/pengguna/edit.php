<?php

$sub_path = "/pengguna";

$id = $_GET["id"];

$title = "Edit Data Pengguna";
$subtitle = "Halaman ini digunakan untuk mengedit data pengguna.";

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/pengguna'>Pengguna</a></li>
    <li class='breadcrumb-item'><a href='/pengguna/edit?id=$id'>Edit Data</a></li>
";

$pengguna = get("pengguna", $id);

if (is_null($pengguna)) {
    return require_once VIEW_PATH . "error/404.php";
}

if(isPetugas()) {
    if(auth()->id != $id) {
        setAlertSession("Anda tidak boleh mengedit data pengguna selain data anda!", "danger");
        return header("Location: /pengguna");
    }
}

require_once VIEW_PATH . "layouts/header.php";
?>

<?php alertMessage() ?>
<section class="section mb-4">
    <div class="card">
        <div class="card-header pb-2 d-flex justify-content-between align-items-center">
            <div class="d-flex">
                <p class="mb-0">
                    Form Edit Data
                </p>
                <div class="badge bg-light-success ms-3">
                    <?= codePengguna($pengguna->id) ?>
                </div>
            </div>
            <a href="/pengguna/ubahpassword/edit?id=<?= $id ?>" class="btn btn-primary px-4 me-2">Ubah Password</a>
        </div>
        <hr class="mx-4">
        <div class="card-content">
            <div class="card-body">
                <form action="/pengguna/update" method="POST">
                    <input hidden name="id" value="<?= $pengguna->id ?>">
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label for="username" class="mb-2">Username <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Text</span>
                                <input name="username" id="username" class="form-control <?= error("username") ?>" placeholder="Masukkan username..." value="<?= old("username", $pengguna->username) ?>">
                                <?php errorMessage("username") ?>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label for="nama" class="mb-2">Nama <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Text</span>
                                <input name="nama" id="nama" class="form-control <?= error("nama") ?>" placeholder="Masukkan nama..." value="<?= old("nama", $pengguna->nama) ?>">
                                <?php errorMessage("nama") ?>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label for="jenis_kelamin" class="mb-2">Jenis Kelamin <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Text</span>
                                <select class="form-select <?= error("jenis_kelamin") ?>" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="" selected>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" <?= old("jenis_kelamin", $pengguna->jenis_kelamin) == "Laki-laki" ? "selected" : "" ?>>Laki-laki</option>
                                    <option value="Perempuan" <?= old("jenis_kelamin", $pengguna->jenis_kelamin) == "Perempuan" ? "selected" : "" ?>>Perempuan</option>
                                </select>
                                <?php errorMessage("jenis_kelamin") ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                         <div class="col-lg mb-4">
                            <label for="telepon" class="mb-2">Telepon <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Text</span>
                                <input name="telepon" id="telepon" class="form-control <?= error("telepon") ?>" placeholder="Masukkan telepon..." value="<?= old("telepon", $pengguna->telepon) ?>">
                                <?php errorMessage("telepon") ?>
                            </div>
                        </div>
                        <?php if(isAdmin()) : ?>
                            <div class="col-lg mb-4">
                                <label for="role" class="mb-2">Role <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Text</span>
                                    <select class="form-select <?= error("role") ?>" id="role" name="role">
                                        <option value="" selected>Pilih Role</option>
                                        <option value="admin" <?= old("role", $pengguna->role) == "admin" ? "selected" : "" ?>>Admin</option>
                                        <option value="petugas" <?= old("role", $pengguna->role) == "petugas" ? "selected" : "" ?>>Petugas</option>
                                    </select>
                                    <?php errorMessage("role") ?>
                                </div>
                            </div>
                            <?php elseif(isPetugas()) : ?>
                                 <div class="col-lg mb-4">
                                    <label for="role" class="mb-2">Role</label>
                                    <input readonly value="<?= auth()->role ?>" class="form-control">
                                </div>
                            <?php endif ?>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label for="alamat" class="mb-2">Alamat <span class="text-danger">*</span></label>
                            <div class="form-group ">
                                <textarea class="form-control <?= error("alamat") ?>" name="alamat" id="alamat" style="height: 150px;" placeholder="Masukkan alamat..."><?= old("alamat", $pengguna->alamat) ?></textarea>
                                <?php errorMessage("alamat") ?>
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