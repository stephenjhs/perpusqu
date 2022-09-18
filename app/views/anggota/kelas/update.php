<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = generateColumns($_POST);
    $id = $_POST["id"];

    if (validation(kelasRules(), $_POST)) {
        update("kelas_anggota", $id, $columns);

        setAlertSession("Data berhasil diubah!", "success");
        return header("Location: /anggota/kelas/edit?id=$id");
    }

    return header("Location: /anggota/kelas/edit?id=$id");
}

return require_once VIEW_PATH .  "error/404.php";
