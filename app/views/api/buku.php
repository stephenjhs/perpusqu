<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$judul = $_GET["judul"];

$data = Capsule::table("buku")->where("judul", "like", "%$judul%")->orderBy("id", "DESC")->get();

foreach($data as $key => $value) {
	$data[$key] = [
		"id" => $value->id,
		"code" => codeBuku($value->id),
		"isbn" => $value->isbn,
		"judul" => $value->judul,
		"pengarang" => $value->pengarang,
		"penerbit" => $value->penerbit,
		"tahun_terbit" => $value->tahun_terbit,
		"jumlah_buku" => $value->jumlah_buku,
		"kategori_id" => get("kategori_buku", $value->kategori_id)->nama_kategori,
		"lokasi_id" => get("lokasi_buku", $value->lokasi_id)->nama_lokasi,
		"total_halaman" => $value->total_halaman,
		"harga" => rp($value->harga),
		"keterangan" => $value->keterangan,
		"sampul" => $value->sampul,
		"peminat" => $value->peminat,
		"dibuat_pada" => timeago("@" . $value->dibuat_pada),
		"diedit_pada" => timeago("@" . $value->diedit_pada),
		"dipinjam" => sumWhere("detail_peminjaman", "buku_id", $value->id, "jumlah_buku"),
	];
}

header('Content-type: application/json');
echo json_encode($data);
?>