<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = generateColumns($_POST);

    if (validation(lokasiRules(), $columns)) {
    insert("lokasi_buku", $columns);

        setAlertSession("Data berhasil ditambahkan!", "success");
        return header("Location: /buku/lokasi");
    }

    return header("Location: /buku/lokasi");
}

return require_once VIEW_PATH .  "error/404.php";
