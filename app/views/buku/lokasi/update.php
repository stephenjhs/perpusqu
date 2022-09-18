<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = generateColumns($_POST);
    $id = $_POST["id"];

    if (validation(lokasiRules(), $columns)) {
        update("lokasi_buku", $id, $columns);

        setAlertSession("Data berhasil diubah!", "success");
        return header("Location: /buku/lokasi/edit?id=$id");
    }

    return header("Location: /buku/lokasi/edit?id=$id");
}

return require_once VIEW_PATH .  "error/404.php";
