<?php 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = generateColumns($_POST);
    $columns["dibuat_pada"] = time();
    $columns["diedit_pada"] = time();
    $columns["peminat"] = 0;

     if (validation(bukuRules(), $_POST)) {
        if ($_FILES["sampul"]["name"] != "") {
            
            $validExtension = ["jpeg", "jpg", "png"];
            $maxSize = 2048000;
            $name = $_FILES["sampul"]["name"];
            $size = $_FILES["sampul"]["size"];
            $tmpName = $_FILES["sampul"]["tmp_name"];
            $ext = strtolower(end(explode(".", $name)));

            if (in_array($ext, $validExtension) === true) {
                if ($size < $maxSize) {
                    $newImage = substr(md5(mt_rand()), 0, 7) . date("yHs") . ".$ext";
                    $columns["sampul"] = $newImage;
                    move_uploaded_file($tmpName, "images/" . $newImage);
                } else {
                    setAlertSession("Data gagal ditambahkan! Ukuran gambar terlalu besar!", "danger");
                    return header("Location: /buku/create");
                }
            } else {
                setAlertSession("Data gagal ditambahkan! File yang dikirim harus gambar!", "danger");
                return header("Location: /buku/create");
            }
        } else {
            $columns["sampul"] = DEFAULT_IMAGE;
        }
        
        insert("buku", $columns);
        setAlertSession("Data berhasil ditambahkan!", "success");
        return header("Location: /buku");
    }
    return header("Location: /buku/create");
}

return require_once VIEW_PATH .  "error/404.php";
