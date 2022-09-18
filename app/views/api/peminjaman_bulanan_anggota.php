<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$data = Capsule::table("detail_peminjaman")->selectRaw("CONCAT_WS('-', MONTH(tanggal_peminjaman)) AS bulan, SUM(jumlah_buku) AS total_buku")->whereIn("peminjaman_id", pluck("peminjaman", "anggota_id", auth()->id, "id"))->groupBy(Capsule::raw("YEAR(tanggal_peminjaman), MONTH(tanggal_peminjaman)"))->get();

header('Content-type: application/json');
echo json_encode($data);
?>