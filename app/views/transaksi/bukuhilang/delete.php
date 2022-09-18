<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$id = $_POST["id"];
	$buku_hilang = get("buku_hilang", $id);

    update("buku", $buku_hilang->buku_id, [
         "jumlah_buku" => get("buku", $buku_hilang->buku_id)->jumlah_buku + $buku_hilang->jumlah_buku
     ]);

	delete("buku_hilang", $id);
     deleteWhere("kas", "tabel_id", "buku_hilang#" . $buku_hilang->id);
	setAlertSession("Data berhasil dihapus!", "success");
	return header("Location: /transaksi/bukuhilang");
}
return require_once VIEW_PATH .  "error/404.php";
