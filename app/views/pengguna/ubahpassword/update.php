<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = generateColumns($_POST);
    $id = $_POST["id"];

    if(isPetugas()) {
        if(auth()->id != $id) {
            setAlertSession("Anda tidak boleh mengedit data pengguna selain data anda!", "danger");
            return header("Location: /pengguna");
        }
    }

    if (validation(ubahpasswordRules(), $_POST)) {
        unset($columns["password_confirmation"]);

        $columns["password"] = password_hash($columns["password"], PASSWORD_DEFAULT);

        update("pengguna", $id, $columns);
        setAlertSession("Password berhasil diubah!", "success");
        return header("Location: /pengguna/edit?id=$id");
    }
    return header("Location: /pengguna/ubahpassword/edit?id=$id");
}

return require_once VIEW_PATH .  "error/404.php";
