<?php

$sub_path = "/pengguna";

$id = $_GET["id"];

$title = "Ubah Password Pengguna";
$subtitle = "Halaman ini digunakan untuk mengubah password pengguna.";

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/pengguna'>Pengguna</a></li>
    <li class='breadcrumb-item'><a href='/pengguna/edit?id=$id'>Edit Data</a></li>
    <li class='breadcrumb-item'><a href='/pengguna/ubahpassword/edit?id=$id'>Ubah Password</a></li>
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
            <p class="mb-0">
                Form Edit Data
            </p>
            <div class="d-flex">
                <div class="badge bg-light-success">
                    <?= codePengguna($pengguna->id) ?>
                </div>
            </div>
        </div>
        <hr class="mx-4">
        <div class="card-content">
            <div class="card-body">
                <form action="/pengguna/ubahpassword/update" method="POST">
                    <input hidden name="id" value="<?= $pengguna->id ?>">
                    <div class="row">
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