<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = generateColumns($_POST);
    $columns["diedit_pada"] = time();
    $id = $_POST["id"];

    if(amountWhere("pengguna", "role", "admin") == 1) {
        if($columns["role"] == "petugas") {
            setAlertSession("Data gagal diubah! Role tidak bisa diubah ke petugas karena anda satu satunya admin!", "danger");
            return header("Location: /pengguna");
        }
    }

    if(isPetugas()) {
        if(auth()->id != $id) {
            setAlertSession("Anda tidak boleh mengedit data pengguna selain data anda!", "danger");
            return header("Location: /pengguna");
        }
    }
    
    if (validation(editPenggunaRules(), $_POST)) {
        if(get("pengguna", $id)->username != $columns["username"]) {
            if(!preg_match("/^\S*$/u", $columns["username"])) {
                setAlertSession("Data gagal ditambahkan! Username tidak boleh mengandung spasi!", "danger");
                return header("Location: /pengguna/edit?id=$id");
            } else if(amountWhere("pengguna", "username", $columns["username"]) == 1 || amountWhere("anggota", "username", $columns["username"]) == 1) {
                setAlertSession("Data gagal ditambahkan! Username sudah ada di database!", "danger");
                return header("Location: /pengguna/edit?id=$id");
            }
        }

        $columns["username"] = strtolower($columns["username"]);

        update("pengguna", $id, $columns);
        setAlertSession("Data berhasil diubah!", "success");
        return header("Location: /pengguna");
    }
    return header("Location: /pengguna/edit?id=$id");
}

return require_once VIEW_PATH .  "error/404.php";
