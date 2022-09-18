<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$id = $_POST["id"];
	$oldImage = get("anggota", $id)->gambar;
	if ($oldImage != DEFAULT_IMAGE) {
		unlink("images/" . $oldImage);
	}
	if(!anggotaRelational($id)) {
		delete("anggota", $id);
		setAlertSession("Data berhasil dihapus!", "success");
		return header("Location: /anggota");
	}
	setAlertSession("Data gagal dihapus! Mungkin ada data yang berelasi!", "danger");
	return header("Location: /anggota");
}

return require_once VIEW_PATH .  "error/404.php";
