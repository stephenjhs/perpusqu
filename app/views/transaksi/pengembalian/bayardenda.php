<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $peminjaman = get("peminjaman", $id);

    update("peminjaman", $id, [
        "denda_dibayarkan" => $peminjaman->denda * day_diff($peminjaman->tanggal_dikembalikan, $peminjaman->batas_pengembalian)
    ]);

    insert("kas", [
        "besaran_kas" => $peminjaman->denda * day_diff($peminjaman->tanggal_dikembalikan, $peminjaman->batas_pengembalian),
        "tabel_id" => "peminjaman#" . $id,
        "tanggal" => date("Y-m-d"),
        "tipe_kas" => "pemasukan",
        "keterangan" => "Denda telat kembalikan buku ". codePeminjaman($id) ." sebesar " . rp($peminjaman->denda * day_diff($peminjaman->tanggal_dikembalikan, $peminjaman->batas_pengembalian)),
    ]);
    
    setAlertSession("Data berhasil dibayar!", "success");
    return header("Location: /transaksi/pengembalian");
}

return require_once VIEW_PATH .  "error/404.php";
