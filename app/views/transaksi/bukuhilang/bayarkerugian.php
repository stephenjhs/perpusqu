<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $buku_hilang = get("buku_hilang", $id);

    update("buku_hilang", $id, [
        "status" => 1
    ]);

    insert("kas", [
        "besaran_kas" => $buku_hilang->harga * $buku_hilang->jumlah_buku,
        "tabel_id" => "buku_hilang#" . latter("buku_hilang"),
        "tanggal" => date("Y-m-d"),
        "tipe_kas" => "pemasukan",
        "keterangan" => "Biaya ganti rugi buku ". get("buku", $buku_hilang->buku_id)->judul ." yang hilang sebesar " . rp($buku_hilang->harga * $buku_hilang->jumlah_buku),
    ]);

    setAlertSession("Data berhasil dibayar!", "success");
    return header("Location: /transaksi/bukuhilang");
}

return require_once VIEW_PATH .  "error/404.php";