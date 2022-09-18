<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$id = $_POST["id"];
	delete("catatan_pengguna", $id);
	setAlertSession("Data berhasil dihapus!", "success");
	return header("Location: /profil/catatan");
}

return require_once VIEW_PATH .  "error/404.php";
