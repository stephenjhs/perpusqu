<?php

$title = "Login";

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = generateColumns($_POST);

    if (validation(loginRules(), $_POST)) {
        if(amountWhere("anggota", "username", $columns["username"]) == 1) {
            $anggota = getWhere("anggota", "username", $columns["username"]);
            if(!password_verify($columns["password"], $anggota->password)) {
                setAlertSession("Password salah!", "danger");
                return header("Location: /login");
            }
            $_SESSION["is_login"] = true;
            $_SESSION["type"] = "anggota";
            $_SESSION["id"] = $anggota->id;

            if(amountWhere("online", "login_id", $_SESSION["id"]) == 0) {
                insert("online", [
                    "login_id" => $_SESSION["id"],
                    "type" => "anggota",
                    "terakhir_dilihat" => time()
                ]);
            }

            setAlertSession("Anda berhasil login!", "success");
            return header("Location: /u/anggota/dashboard");
        } elseif(amountWhere("pengguna", "username", $columns["username"]) == 1) {
            $pengguna = getWhere("pengguna", "username", $columns["username"]);
            if(!password_verify($columns["password"], $pengguna->password)) {
                setAlertSession("Password salah!", "danger");
                return header("Location: /login");                
            }

            $_SESSION["is_login"] = true;
            $_SESSION["type"] = "pengguna";
            $_SESSION["id"] = $pengguna->id;

            if(amountWhere("online", "login_id", $_SESSION["id"]) == 0) {
                insert("online", [
                    "login_id" => $_SESSION["id"],
                    "type" => "pengguna",
                    "terakhir_dilihat" => time()
                ]);
            }

            setAlertSession("Anda berhasil login!", "success");
            return header("Location: /dashboard");
        } else {
            setAlertSession("Username tidak ditemukan!", "danger");
            return header("Location: /login");      
        }
    }

    return header("Location: /login");

}
require_once VIEW_PATH . "layouts/auth/header.php"

 ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card mt-5">
                    <div class="card-header pb-2 d-flex justify-content-between align-items-center">
                        <h3 class="mb-0 font-extrabold fs-6 text-uppercase">Login</h3>
                        <a href="/" class="mb-0"><?= APP_NAME ?></a>
                    </div>
                    <hr class="mx-4">
                    <div class="card-body">
                        <?php alertMessage() ?>
                         <form action="/login" method="POST">
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
                            </div>
                            <div class="row">
                                <div class="col-auto ms-auto">
                                    <a href="/registrasi" class="me-4">Registrasi</a>
                                    <button type="submit" class="btn btn-primary px-4">Masuk</button>
                                </div>
                            </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
<?php require_once VIEW_PATH . "layouts/auth/footer.php" ?>