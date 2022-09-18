<?php 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = generateColumns($_POST);
    $columns["dibuat_pada"] = time();
    $columns["diedit_pada"] = time();

    if (validation(anggotaRules(), $_POST)) {
        unset($columns["password_confirmation"]);
        
        if ($_FILES["gambar"]["name"] != "") {

            $validExtension = ["jpeg", "jpg", "png"];
            $maxSize = 2048000;
            $name = $_FILES["gambar"]["name"];
            $size = $_FILES["gambar"]["size"];
            $tmpName = $_FILES["gambar"]["tmp_name"];
            $ext = strtolower(end(explode(".", $name)));

            if (in_array($ext, $validExtension) === true) {
                if ($size < $maxSize) {
                    $newImage = substr(md5(mt_rand()), 0, 7) . date("yHs") . ".$ext";
                    $columns["gambar"] = $newImage;
                    move_uploaded_file($tmpName, "images/" . $newImage);
                } else {
                    setAlertSession("Data gagal ditambahkan! Ukuran gambar terlalu besar!", "danger");
                    return header("Location: /anggota/create");
                }
            } else {
                setAlertSession("Data gagal ditambahkan! File yang dikirim harus gambar!", "danger");
                return header("Location: /anggota/create");
            }
        } else {
            $columns["gambar"] = DEFAULT_IMAGE;
        }

        if(!preg_match("/^\S*$/u", $columns["username"])) {
            setAlertSession("Data gagal ditambahkan! Username tidak boleh mengandung spasi!", "danger");
            return header("Location: /anggota/create");
        } else if(amountWhere("anggota", "username", $columns["username"]) == 1 || amountWhere("pengguna", "username", $columns["username"]) == 1) {
            setAlertSession("Data gagal ditambahkan! Username sudah ada di database!", "danger");
            return header("Location: /anggota/create");
        }

        $columns["username"] = strtolower($columns["username"]);
        $columns["password"] = password_hash($columns["password"], PASSWORD_DEFAULT);
        
        insert("anggota", $columns);
        setAlertSession("Data berhasil ditambahkan!", "success");
        return header("Location: /anggota");
    }
    return header("Location: /anggota/create");
}

return require_once VIEW_PATH .  "error/404.php";
