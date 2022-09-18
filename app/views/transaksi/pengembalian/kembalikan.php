<?php

use Illuminate\Database\Capsule\Manager as Capsule;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $detail_peminjaman = get("detail_peminjaman", $id);

    update("detail_peminjaman", $id, [
        "tanggal_dikembalikan" => date("Y-m-d"),
        "status" => 1
    ]);

    if(!Capsule::table("detail_peminjaman")->where("peminjaman_id", $detail_peminjaman->id)->where("status", 0)->count() > 0) {
        update("peminjaman", $detail_peminjaman->peminjaman_id, [
            "tanggal_dikembalikan" => date("Y-m-d"),
            "status" => 1
        ]);
    }

    update("buku", $detail_peminjaman->buku_id, [
        "jumlah_buku" => get("buku", $detail_peminjaman->buku_id)->jumlah_buku + $detail_peminjaman->jumlah_buku
    ]);

    setAlertSession("Data berhasil dikembalikan!", "success");
    return header("Location: /transaksi/pengembalian");
}

return require_once VIEW_PATH .  "error/404.php";









