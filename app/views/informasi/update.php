<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = generateColumns($_POST);
    $columns["diedit_pada"] = time();

    if (validation(informasiRules(), $_POST)) {
       
        update("informasi", 1, $columns);
        setAlertSession("Data berhasil diubah!", "success");
        return header("Location: /informasi");
    }
    return header("Location: /informasi/edit?id=$id");
}

return require_once VIEW_PATH .  "error/404.php";
