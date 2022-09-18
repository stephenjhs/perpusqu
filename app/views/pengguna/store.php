<?php 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = generateColumns($_POST);
    $columns["dibuat_pada"] = time();
    $columns["diedit_pada"] = time();

    if (validation(penggunaRules(), $_POST)) {
        unset($columns["password_confirmation"]);
        if(!preg_match("/^\S*$/u", $columns["username"])) {
            setAlertSession("Data gagal ditambahkan! Username tidak boleh mengandung spasi!", "danger");
            return header("Location: /pengguna/create");
        } else if(amountWhere("pengguna", "username", $columns["username"]) == 1 || amountWhere("anggota", "username", $columns["username"]) == 1) {
            setAlertSession("Data gagal ditambahkan! Username sudah ada di database!", "danger");
            return header("Location: /pengguna/create");
        }

        $columns["username"] = strtolower($columns["username"]);
        $columns["password"] = password_hash($columns["password"], PASSWORD_DEFAULT);
        insert("pengguna", $columns);
        setAlertSession("Data berhasil ditambahkan!", "success");
        return header("Location: /pengguna");
    }
    return header("Location: /pengguna/create");
}

return require_once VIEW_PATH .  "error/404.php";
