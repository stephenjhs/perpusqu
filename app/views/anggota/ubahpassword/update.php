<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = generateColumns($_POST);
    $id = $_POST["id"];

    if (validation(ubahpasswordRules(), $_POST)) {
        unset($columns["password_confirmation"]);

        $columns["password"] = password_hash($columns["password"], PASSWORD_DEFAULT);

        update("anggota", $id, $columns);
        setAlertSession("Password berhasil diubah!", "success");
        return header("Location: /anggota/edit?id=$id");
    }
    return header("Location: /anggota/ubahpassword/edit?id=$id");
}

return require_once VIEW_PATH .  "error/404.php";
