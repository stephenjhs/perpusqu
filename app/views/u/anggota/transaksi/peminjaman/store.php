<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $peminjaman_id = latter("peminjaman") + 1;
    $detail_peminjaman = [];

    foreach($_POST["buku_id"] as $key => $value) {
        if($_POST["jumlah_buku"][$key] <= 0) {
            setAlertSession("Data gagal ditambahkan! Jumlah buku kosong atau lebih kecil dari 0!", "danger");
            return header("Location: /u/anggota/transaksi/peminjaman");
        } elseif(get("buku", $_POST["buku_id"][$key])->jumlah_buku < $_POST["jumlah_buku"][$key]) {
            setAlertSession("Data gagal ditambahkan! Jumlah buku tidak boleh lebih besar dari jumlah buku sekarang!", "danger");
            return header("Location: /u/anggota/transaksi/peminjaman");
        }
        
        $detail_peminjaman[$key] = [
            "peminjaman_id" => $peminjaman_id,
            "buku_id" => $_POST["buku_id"][$key],
            "jumlah_buku" => $_POST["jumlah_buku"][$key],
            "tanggal_peminjaman" => date("Y-m-d"),
            "tanggal_dikembalikan" => null,
            "status" => 0
        ];

        update("buku", $_POST["buku_id"][$key], [
            "jumlah_buku" => get("buku", $_POST["buku_id"][$key])->jumlah_buku - $_POST["jumlah_buku"][$key]
        ]);
    }
    
    if(!isset($_POST["buku_id"])) {
        setAlertSession("Data gagal ditambahkan! Daftar buku kosong!", "danger");
        return header("Location: /u/anggota/transaksi/peminjaman");
    }

    insert("peminjaman", [
        "id" => $peminjaman_id,
        "anggota_id" => auth()->id,
        "pengguna_id" => null,
        "tanggal_peminjaman" => date("Y-m-d"),
        "batas_pengembalian" => date("Y-m-d", time() + 604800),
        "tanggal_dikembalikan" => null,
        "denda" => first("denda")->besaran_denda,
        "denda_dibayarkan" => 0,
        "status" => 0,
    ]);

    insert("detail_peminjaman", $detail_peminjaman);

    insert("notifikasi", [
        "isi_notifikasi" => auth()->username . " meminjam buku sebanyak " . sumWhere("detail_peminjaman", "peminjaman_id", $peminjaman_id, "jumlah_buku") . " buah",
        "dibuat_pada" => time() 
    ]);

    setAlertSession("Data berhasil ditambahkan!", "success");
    return header("Location: /u/anggota/transaksi");
}

return require_once VIEW_PATH .  "error/404.php";
