<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = generateColumns($_POST);
    $id = $_POST["id"];
    $peminjaman = get("peminjaman", $id);

    if ($columns["batas_pengembalian"] == "") {
        setAlertSession("Data gagal diperpanjang! Batas pengembalian tidak boleh kosong!", "danger");
        return header("Location: /transaksi/pengembalian");
    } else if($columns["batas_pengembalian"] < $peminjaman->tanggal_peminjaman) {
        setAlertSession("Data gagal diperpanjang! Batas pengembalian tidak boleh lebih kecil dari tanggal peminjaman!", "danger");
        return header("Location: /transaksi/pengembalian");
    } 

    update("peminjaman", $id, $columns);
    setAlertSession("Data berhasil diperpanjang!", "success");
    return header("Location: /transaksi/pengembalian");
}

return require_once VIEW_PATH .  "error/404.php";
