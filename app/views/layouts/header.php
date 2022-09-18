<?php     
    use Illuminate\Database\Capsule\Manager as Capsule;

    if(isset($_SESSION["id"])) {
        if(Capsule::table("online")->where("login_id", $_SESSION["id"])->where("type", $_SESSION["type"])->count() == 0) {
            insert("online", [
                "login_id" => $_SESSION["id"],
                "type" => $_SESSION["type"],
                "terakhir_dilihat" => time()
            ]);
        }

        Capsule::table("online")->where("login_id", $_SESSION["id"])->where("type", $_SESSION["type"])->update(["terakhir_dilihat" => time()]);
    }
    
    if($_SESSION["type"] == "pengguna") {
        $base_path = "/" . explode("/", $_SERVER["REQUEST_URI"])[1];
    } elseif($_SESSION["type"] == "anggota") {
        $base_path = "/" . explode("/", $_SERVER["REQUEST_URI"])[3];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> &ndash; <?= APP_NAME ?></title>

    <link rel="stylesheet" href="/mazer/css/main/app.css">
    <link rel="stylesheet" href="/mazer/css/main/app-dark.css">
    <link rel="stylesheet" href="/css/custom.css">
</head>

<body>
    <div id="app">
        <?php require_once VIEW_PATH . "layouts/sidebar.php" ?>

        <div id="main" class='layout-navbar'>
            <?php require_once VIEW_PATH . "layouts/navbar.php" ?>
            <div id="main-content">
                <div class="page-heading mb-2">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3><?= $title ?></h3>
                                <p class="text-subtitle text-muted"><?= $subtitle ?></p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <?= $breadcrumbs ?>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>