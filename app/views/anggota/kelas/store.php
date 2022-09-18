<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = generateColumns($_POST);
    
    if (validation(kelasRules(), $_POST)) {
        insert("kelas_anggota", $columns);

        setAlertSession("Data berhasil ditambahkan!", "success");
        return header("Location: /anggota/kelas");
    }

    return header("Location: /anggota/kelas");
}

return require_once VIEW_PATH .  "error/404.php";
