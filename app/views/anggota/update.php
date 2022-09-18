<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = generateColumns($_POST);
    $columns["diedit_pada"] = time();
    $id = $_POST["id"];

    if (validation(editAnggotaRules(), $_POST)) {
        if ($_FILES["gambar"]["name"] != "") {
            
            $validExtension = ["jpeg", "jpg", "png"];
            $maxSize = 2048000;
            $name = $_FILES["gambar"]["name"];
            $size = $_FILES["gambar"]["size"];
            $tmpName = $_FILES["gambar"]["tmp_name"];
            $ext = strtolower(end(explode(".", $name)));

            if (in_array($ext, $validExtension) === true) {
                if ($size < $maxSize) {
                    $oldImage = get("anggota", $id)->gambar;
                    if ($oldImage != DEFAULT_IMAGE) {
                        unlink("images/" . $oldImage);
                    }
                    $newImage = substr(md5(mt_rand()), 0, 7) . date("yHs") . ".$ext";
                    $columns["gambar"] = $newImage;
                    move_uploaded_file($tmpName, "images/" . $newImage);
                } else {
                    setAlertSession("Data gagal ditambahkan! Ukuran gambar terlalu besar!", "danger");
                    return header("Location: /anggota/edit?id=$id");
                }
            } else {
                setAlertSession("Data gagal ditambahkan! File yang dikirim harus gambar!", "danger");
                return header("Location: /anggota/edit?id=$id");
            }
        }

        if(get("anggota", $id)->username != $columns["username"]) {
            if(!preg_match("/^\S*$/u", $columns["username"])) {
                setAlertSession("Data gagal ditambahkan! Username tidak boleh mengandung spasi!", "danger");
                return header("Location: /anggota/edit?id=$id");
            } else if(amountWhere("anggota", "username", $columns["username"]) == 1 || amountWhere("pengguna", "username", $columns["username"]) == 1) {
                setAlertSession("Data gagal ditambahkan! Username sudah ada di database!", "danger");
                return header("Location: /anggota/edit?id=$id");
            }
        }

        $columns["username"] = strtolower($columns["username"]);

        update("anggota", $id, $columns);
        setAlertSession("Data berhasil diubah!", "success");
        return header("Location: /anggota");
    }
    return header("Location: /anggota/edit?id=$id");
}

return require_once VIEW_PATH .  "error/404.php";
