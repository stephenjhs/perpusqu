<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = generateColumns($_POST);
    $id = $_POST["id"];

     if ($columns["besaran_denda"] == "") {
        setAlertSession("Data gagal diubah! Besaran denda tidak boleh kosong!", "danger");
        return header("Location: /transaksi/denda");
    }

    update("denda", $id, $columns);
    setAlertSession("Data berhasil diubah!", "success");
    return header("Location: /transaksi/denda");
}

return require_once VIEW_PATH .  "error/404.php";
