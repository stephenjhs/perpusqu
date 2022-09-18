<?php

if($_SERVER["REQUEST_METHOD"] === "POST") {
	$id = $_POST["id"];
	if (!lokasiRelational($id)) {
    	delete("lokasi_buku", $id);
    	setAlertSession("Data berhasil dihapus!", "success");
		return header("Location: /buku/lokasi");
	}
    setAlertSession("Data gagal dihapus! Mungkin ada data yang berelasi!", "danger");
	return header("Location: /buku/lokasi");
}

return require_once VIEW_PATH .  "error/404.php";

