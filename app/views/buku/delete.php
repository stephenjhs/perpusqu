<?php 
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		$id = $_POST["id"];
		$oldImage = get("buku", $id)->sampul; 
	    if($oldImage != DEFAULT_IMAGE) {
	        unlink("images/" . $oldImage);
	    }
	    if(!bukuRelational($id)) {
	    	delete("buku", $id);
		    setAlertSession("Data berhasil dihapus!", "success");
			return header("Location: /buku");
	    }
	    setAlertSession("Data gagal dihapus! Mungkin ada data yang berelasi!", "danger");
		return header("Location: /buku");
	}
return require_once VIEW_PATH .  "error/404.php";