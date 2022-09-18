<?php 

use Illuminate\Database\Capsule\Manager as Capsule;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	Capsule::table("online")->where("login_id", $_SESSION["id"])->where("type", $_SESSION["type"])->delete();
	session_destroy();
	session_start();

	setAlertSession("Anda berhasil logout!", "success");
	return header("Location: /login");    
}

return require_once VIEW_PATH .  "error/404.php";