<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$id = $_POST["id"];

	if(get("peminjaman", $id)->status == 0) {
		foreach(allWhere("detail_peminjaman", "peminjaman_id", $id) as $detail_peminjaman) {
	        update("buku", $detail_peminjaman->buku_id, [
	            "jumlah_buku" => get("buku", $detail_peminjaman->buku_id)->jumlah_buku + $detail_peminjaman->jumlah_buku
	        ]);
	    }
	}
	
    deleteWhere("kas", "tabel_id", "peminjaman#" . $id);
	deleteWhere("detail_peminjaman", "peminjaman_id", $id);
	delete("peminjaman", $id);
	
	setAlertSession("Data berhasil dihapus!", "success");
	return header("Location: /transaksi/pengembalian");
}

return require_once VIEW_PATH .  "error/404.php";
