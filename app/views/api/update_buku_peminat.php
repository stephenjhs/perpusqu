<?php 
use Illuminate\Database\Capsule\Manager as Capsule;

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $request = json_decode(file_get_contents("php://input"));
    return update("buku", $request->id, ["peminat" => get("buku", $request->id)->peminat + 1]);
} else {
    return require_once VIEW_PATH .  "error/404.php";
}

?>