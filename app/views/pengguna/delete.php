<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$id = $_POST["id"];

	if(!penggunaRelational($id)) {
		if(amountWhere("pengguna", "role", "admin") == 1) {
			setAlertSession("Data gagal dihapus! Harus ada satu admin didalam database!", "danger");
			return header("Location: /pengguna");
		}
		deleteWhere("catatan_pengguna", "pengguna_id", $id);
		delete("pengguna", $id);
		if($_SESSION["id"] == $id) {
			session_destroy();
			session_start();
			setAlertSession("Data berhasil dihapus! Sesi anda otomatis dihapus!", "success");
			return header("Location: /login");	
		}
		setAlertSession("Data berhasil dihapus!", "success");
		return header("Location: /pengguna");
	}
	setAlertSession("Data gagal dihapus! Mungkin ada data yang berelasi!", "danger");
	return header("Location: /pengguna");
}

return require_once VIEW_PATH .  "error/404.php";
