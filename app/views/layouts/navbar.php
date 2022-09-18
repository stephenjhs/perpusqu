<?php 
use Illuminate\Database\Capsule\Manager as Capsule;
$notifikasi_waktu = 86400;
?>

<header class='mb-3'>
    <nav class="navbar navbar-expand navbar-light ">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php if($_SESSION["type"] == "pengguna") : ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-lg-0">
                  
                  <li class="nav-item dropdown me-3">
                    <a
                      class="nav-link active dropdown-toggle text-gray-600"
                      href="#"
                      data-bs-toggle="dropdown"
                      data-bs-display="static"
                      aria-expanded="false"
                    >
                        <?php if(Capsule::table("notifikasi")->where("dibuat_pada", ">=", time() - $notifikasi_waktu)->count() > 0) : ?>
                            <span class="notification-badge"><?= Capsule::table("notifikasi")->where("dibuat_pada", ">=", time() - $notifikasi_waktu)->count() ?></span>
                        <?php endif ?>
                      <i class="bi bi-bell bi-sub fs-4"></i>
                    </a>
                    <ul
                      class="dropdown-menu dropdown-menu-end notification-dropdown"
                      aria-labelledby="dropdownMenuButton"
                    >
                   
                      <li class="dropdown-header">
                        <h6>Notifikasi Hari Ini</h6>
                      </li>
                       <?php if(Capsule::table("notifikasi")->where("dibuat_pada", ">=", time() - $notifikasi_waktu)->count() == 0) : ?>
                        <li class="dropdown-item py-3">
                        <p class="text-muted mb-0">Tidak ada pemberitahuan untuk saat ini.</p>
                    </li>
                    <?php endif ?>
                        <?php foreach(Capsule::table("notifikasi")->where("dibuat_pada", ">=", time() - $notifikasi_waktu)->orderBy("id", "DESC")->limit(5)->get() as $notifikasi) : ?>
                        <li class="dropdown-item py-3">
                            <a class="d-flex align-items-center" href"#">          
                              <div class="">
                                <p class="dropdown-item p-0 mb-2 font-bold">
                                  <?= $notifikasi->isi_notifikasi ?>
                                </p>
                                <p class="text-muted font-thin mb-0 text-sm">
                                  <?= timeago("@" . $notifikasi->dibuat_pada) ?>
                                </p>
                              </div>
                            </a>
                      </li>
                            <?php endforeach ?>
                      <li>
                        <p class="text-center py-2 mb-0">
                          <a href="/pengaturan/notifikasi">Lihat semua notifikasi</a>
                        </p>
                      </li>
                    </ul>
                  </li>
                </ul>
                <div class="dropdown">
                    <a data-bs-toggle="dropdown" href="#">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600"><?= auth()->nama ?></h6>
                                <p class="mb-0 text-sm text-gray-600">
                                    <?= ucwords(auth()->role) ?>
                                </p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img style="object-fit: cover" src="/images/profil/<?= auth()->role ?>.jpg">
                                </div>
                            </div>
                        </div>
                    </a>
                     <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                        <li><a class="dropdown-item" href="/profil">Profil</a></li>
                        <li><a class="dropdown-item" href="/profil/catatan">Catatan</a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#keluar">Keluar</a></li>
                    </ul>
                </div>
            </div>
            <?php elseif($_SESSION["type"] == "anggota") : ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="dropdown ms-auto">
                    <a data-bs-toggle="dropdown" href="#">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600"><?= auth()->nama ?></h6>
                                <p class="mb-0 text-sm text-gray-600">
                                    Anggota
                                </p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img style="object-fit: cover" src="/images/<?= auth()->gambar ?>">
                                </div>
                            </div>
                        </div>
                    </a>
                     <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                        <li><a class="dropdown-item" href="/u/anggota/profil">Profil</a></li>
                        <li><a class="dropdown-item" href="/u/anggota/profil/edit">Edit Profil</a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#keluar">Keluar</a></li>
                    </ul>
                </div>
            </div>
            <?php endif ?>
            
        </div>
    </nav>
</header>