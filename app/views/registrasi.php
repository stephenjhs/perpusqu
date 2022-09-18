<?php 
$title = "Registrasi";

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = generateColumns($_POST);
    $columns["dibuat_pada"] = time();
    $columns["diedit_pada"] = time();
    $columns["gambar"] = DEFAULT_IMAGE;

    if (validation(registrasiRules(), $_POST)) {
        unset($columns["password_confirmation"]);

        if(!preg_match("/^\S*$/u", $columns["username"])) {
            setAlertSession("Data gagal ditambahkan! Username tidak boleh mengandung spasi!", "danger");
            return header("Location: /registrasi");
        } else if(amountWhere("anggota", "username", $columns["username"]) == 1 || amountWhere("pengguna", "username", $columns["username"]) == 1) {
            setAlertSession("Data gagal ditambahkan! Username sudah ada di database!", "danger");
            return header("Location: /registrasi");
        }

        $columns["username"] = strtolower($columns["username"]);
        $columns["password"] = password_hash($columns["password"], PASSWORD_DEFAULT);

        insert("anggota", $columns);
        $anggota = getWhere("anggota", "username", $columns["username"]);

        $_SESSION["is_login"] = true;
        $_SESSION["type"] = "anggota";
        $_SESSION["id"] = $anggota->id;

        insert("online", [
            "login_id" => $_SESSION["id"],
            "type" => "anggota",
            "terakhir_dilihat" => time()
        ]);

        insert("notifikasi", [
            "isi_notifikasi" => $anggota->username . " berhasil registrasi sebagai anggota perpustakaan.",
            "dibuat_pada" => time() 
        ]);

        setAlertSession("Anda berhasil registrasi! Segera lengkapi data anda!", "success");
        return header("Location: /u/anggota/dashboard");
    }
    return header("Location: /registrasi");
}

require_once VIEW_PATH . "/layouts/auth/header.php";
?>

<div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card mt-5">
                    <div class="card-header pb-2 d-flex justify-content-between align-items-center">
                        <h3 class="mb-0 font-extrabold fs-6 text-uppercase">Registrasi</h3>
                        <a href="/" class="mb-0"><?= APP_NAME ?></a>
                    </div>
                    <hr class="mx-4">
                    <div class="card-body">
                        <?php alertMessage() ?>
                         <form action="/registrasi" method="POST">
                            <div class="row">
                                <div class="col-lg mb-4">
                                    <label class="mb-2" for="nama">Nama <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input name="nama" id="nama" class="form-control <?= error("nama") ?>" value="<?= old("nama") ?>" placeholder="Masukkan nama...">
                                        <?php errorMessage("nama") ?>
                                    </div>
                                </div>
                                <div class="col-lg mb-4">
                                    <label class="mb-2" for="nis">NIS <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" name="nis" id="nis" class="form-control <?= error("nis") ?>" value="<?= old("nis") ?>" placeholder="Masukkan nis...">
                                        <?php errorMessage("nis") ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg mb-4">
                                    <label for="kelas" class="mb-2">Kelas <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="form-select <?= error("kelas_id") ?>" id="kelas" name="kelas_id">
                                            <option value="" selected>Pilih Kelas</option>
                                            <?php foreach (all("kelas_anggota") as $kelas) : ?>
                                                <option value="<?= $kelas->id ?>" <?= old("kelas_id") == $kelas->id ? "selected" : "" ?>><?= $kelas->nama_kelas ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <?php errorMessage("kelas_id") ?>
                                    </div>
                                </div>
                                <div class="col-lg mb-4">
                                    <label for="jenis_kelamin" class="mb-2">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="form-select <?= error("jenis_kelamin") ?>" id="jenis_kelamin" name="jenis_kelamin">
                                            <option value="" selected>Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki" <?= old("jenis_kelamin") == "Laki-laki" ? "selected" : "" ?>>Laki-laki</option>
                                            <option value="Perempuan" <?= old("jenis_kelamin") == "Perempuan" ? "selected" : "" ?>>Perempuan</option>
                                        </select>
                                        <?php errorMessage("jenis_kelamin") ?>
                                    </div>
                                </div>
                            </div>      
                            <div class="row">
                                <div class="col-lg mb-4">
                                    <label class="mb-2" for="username">Username <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input name="username" id="username" class="form-control <?= error("username") ?>" value="<?= old("username") ?>" placeholder="Masukkan username...">
                                        <?php errorMessage("username") ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg mb-4">
                                    <label class="mb-2" for="password">Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control <?= error("password") ?>" value="<?= old("password") ?>" placeholder="Masukkan password...">
                                        <?php errorMessage("password") ?>
                                    </div>
                                </div>
                                <div class="col-lg mb-4">
                                    <label class="mb-2" for="password_confirmation">Konfirmasi Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control <?= error("password_confirmation") ?>" value="<?= old("password_confirmation") ?>" placeholder="Masukkan konfirmasi password...">
                                        <?php errorMessage("password_confirmation") ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-auto ms-auto">
                                    <a href="/login" class="me-4">Login</a>
                                    <button type="submit" class="btn btn-primary px-4">Daftar</button>
                                </div>
                            </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
<?php require_once VIEW_PATH . "layouts/auth/footer.php" ?>