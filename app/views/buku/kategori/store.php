<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = generateColumns($_POST);

    if (validation(kategoriRules(), $_POST)) {
        insert("kategori_buku", $columns);

        setAlertSession("Data berhasil ditambahkan!", "success");
        return header("Location: /buku/kategori");
    }

    return header("Location: /buku/kategori");
}

return require_once VIEW_PATH .  "error/404.php";
