<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = generateColumns($_POST);
    $id = auth()->id;

    if (validation(ubahpasswordRules(), $_POST)) {
        unset($columns["password_confirmation"]);

        $columns["password"] = password_hash($columns["password"], PASSWORD_DEFAULT);

        update("anggota", $id, $columns);
        setAlertSession("Password berhasil diubah!", "success");
        return header("Location: /u/anggota/profil/edit");
    }
    return header("Location: /u/anggota/profil/ubahpassword");
}

return require_once VIEW_PATH .  "error/404.php";
