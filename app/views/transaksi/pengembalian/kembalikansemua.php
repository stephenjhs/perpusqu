<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];

    foreach(allWhere("detail_peminjaman", "peminjaman_id", $id) as $detail_peminjaman) {
        update("buku", $detail_peminjaman->buku_id, [
            "jumlah_buku" => get("buku", $detail_peminjaman->buku_id)->jumlah_buku + $detail_peminjaman->jumlah_buku
        ]);
    }

    updateWhere("detail_peminjaman", "peminjaman_id", $id, [
        "tanggal_dikembalikan" => date("Y-m-d"),
        "status" => 1
    ]);

    update("peminjaman", $id, [
        "tanggal_dikembalikan" => date("Y-m-d"),
        "status" => 1
    ]);

    setAlertSession("Data berhasil dikembalikan!", "success");
    return header("Location: /transaksi/pengembalian");
}

return require_once VIEW_PATH .  "error/404.php";