<?php 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = generateColumns($_POST);
    $columns["diedit_pada"] = time();
    $id = $_POST["id"];

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
                    $oldImage = get("buku", $id)->sampul;   
                    if($oldImage != DEFAULT_IMAGE) {
                        unlink("images/" . $oldImage);
                    } 
                    $newImage = substr(md5(mt_rand()), 0, 7) . date("yHs") . ".$ext";
                    $columns["sampul"] = $newImage;
                    move_uploaded_file($tmpName, "images/" . $newImage);
                } else {
                    setAlertSession("Data gagal ditambahkan! Ukuran gambar terlalu besar!", "danger");
                    return header("Location: /buku/edit?id=$id");
                }
            } else {
                setAlertSession("Data gagal ditambahkan! File yang dikirim harus gambar!", "danger");
                return header("Location: /buku/edit?id=$id");
            }
        } 

        update("buku", $id, $columns);
        setAlertSession("Data berhasil diubah!", "success");
        return header("Location: /buku");
    }
    return header("Location: /buku/edit?id=$id");
}

return require_once VIEW_PATH .  "error/404.php";
