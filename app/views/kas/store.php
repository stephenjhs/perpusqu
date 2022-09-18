<?php 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = generateColumns($_POST);
    $columns["tanggal"] = date("Y-m-d");

    if (validation(kasRules(), $_POST)) {
        
        insert("kas", $columns);
        setAlertSession("Data berhasil ditambahkan!", "success");
        return header("Location: /kas");
    }
    return header("Location: /kas/create");
}

return require_once VIEW_PATH .  "error/404.php";
