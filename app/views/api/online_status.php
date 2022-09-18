<?php 
use Illuminate\Database\Capsule\Manager as Capsule;

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(Capsule::table("online")->where("login_id", $_SESSION["id"])->where("type", $_SESSION["type"])->count() == 0) {
        insert("online", [
            "login_id" => $_SESSION["id"],
            "type" => $_SESSION["type"],
            "terakhir_dilihat" => time()
        ]);
    }

    Capsule::table("online")->where("login_id", $_SESSION["id"])->where("type", $_SESSION["type"])->update(["terakhir_dilihat" => time()]);
} else {
    return require_once VIEW_PATH .  "error/404.php";
}

?>