<?php

use Illuminate\Database\Capsule\Manager as Capsule;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if($_POST["konfirmasi"] == "") {
		setAlertSession("Data gagal dihapus! Konfirmasi tidak boleh kosong!", "danger");
		return header("Location: /pengaturan");
	}

	if($_POST["konfirmasi"] == "KONFIRMASI") {
		
		$keepFiles = [DEFAULT_IMAGE, "profil", "home"];

		foreach (glob("images/*") as $file) {
		    if(!in_array(basename($file), $keepFiles))
		        unlink($file);
		}

		setAlertSession("Anda berhasil menghapus semua gambar! Hapus gambar seperlunya, agar penyimpanan tidak penuh!", "success");
		return header("Location: /pengaturan");
	}

	setAlertSession("Data gagal dihapus! Konfirmasi tidak sesuai!", "danger");
	return header("Location: /pengaturan");
}

return require_once VIEW_PATH .  "error/404.php";
