<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$columns = generateColumns($_POST);
	$columns["pengguna_id"] = auth()->id;	
	$columns["dibuat_pada"] = time();	

	if($columns["isi_catatan"] == "") {
		setAlertSession("Data gagal ditambahkan! Kolom tidak boleh kosong!", "danger");
		return header("Location: /profil/catatan");	
	}

	insert("catatan_pengguna", $columns);
	setAlertSession("Data berhasil ditambahkan!", "success");
	return header("Location: /profil/catatan");
}

return require_once VIEW_PATH .  "error/404.php";
