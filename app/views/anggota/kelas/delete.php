<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$id = $_POST["id"];
	if (!kelasRelational($id)) {
		delete("kelas_anggota", $id);
		setAlertSession("Data berhasil dihapus!", "success");
		return header("Location: /anggota/kelas");
	}
	setAlertSession("Data gagal dihapus! Mungkin ada data yang berelasi!", "danger");
	return header("Location: /anggota/kelas");
}
require_once VIEW_PATH .  "error/404.php";
