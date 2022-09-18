<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center mt-2">
                <div class="logo">
                    <h3 class="mb-0 font-extrabold fs-6 text-uppercase"><a href="/" class="text-white"><?= APP_NAME ?></a></h3>
                </div>
               
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <?php if($_SESSION["type"] == "pengguna") : ?>
                <ul class="menu">
                    <li class="sidebar-title">Menu</li>

                    <li class="sidebar-item <?= $base_path == "/dashboard" ? "active" : "" ?>">
                        <a href="/dashboard" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item <?= $base_path == "/anggota" ? "active" : "" ?> has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-person-lines-fill"></i>
                            <span>Anggota</span>
                        </a>
                        <ul class="submenu <?= $base_path == "/anggota" ? "active" : "" ?>">
                            <li class="submenu-item <?= $sub_path == "/anggota" ? "active" : "" ?>">
                                <a href="/anggota">Data Anggota</a>
                            </li>
                            <li class="submenu-item <?= $sub_path == "/anggota/kelas" ? "active" : "" ?>">
                                <a href="/anggota/kelas">Kelas</a>
                            </li>
                         </ul>
                    </li>

                    <li class="sidebar-item <?= $base_path == "/buku" ? "active" : "" ?> has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-layers-fill"></i>
                            <span>Buku</span>
                        </a>
                        <ul class="submenu <?= $base_path == "/buku" ? "active" : "" ?>">
                            <li class="submenu-item <?= $sub_path == "/buku" ? "active" : "" ?>">
                                <a href="/buku">Data Buku</a>
                            </li>
                            <li class="submenu-item <?= $sub_path == "/buku/kategori" ? "active" : "" ?>">
                                <a href="/buku/kategori">Kategori</a>
                            </li>
                            <li class="submenu-item <?= $sub_path == "/buku/lokasi" ? "active" : "" ?>">
                                <a href="/buku/lokasi">Lokasi</a>
                            </li>                      
                         </ul>
                    </li>

                    <li class="sidebar-item <?= $base_path == "/transaksi" ? "active" : "" ?> has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-arrow-left-right"></i>
                            <span>Transaksi</span>
                        </a>
                        <ul class="submenu <?= $base_path == "/transaksi" ? "active" : "" ?>">
                            <li class="submenu-item <?= $sub_path == "/transaksi" ? "active" : "" ?>">
                                <a href="/transaksi">Data Transaksi</a>
                            </li>
                            <li class="submenu-item <?= $sub_path == "/transaksi/peminjaman" ? "active" : "" ?>">
                                <a href="/transaksi/peminjaman">Peminjaman</a>
                            </li>   
                            <li class="submenu-item <?= $sub_path == "/transaksi/pengembalian" ? "active" : "" ?>">
                                <a href="/transaksi/pengembalian">Pengembalian</a>
                            </li>
                            <li class="submenu-item <?= $sub_path == "/transaksi/denda" ? "active" : "" ?>">
                                <a href="/transaksi/denda">Denda</a>
                            </li>
                            <li class="submenu-item <?= $sub_path == "/transaksi/bukuhilang" ? "active" : "" ?>">
                                <a href="/transaksi/bukuhilang">Buku Hilang</a>
                            </li>
                         </ul>
                    </li>

                    <li class="sidebar-item <?= $base_path == "/kas" ? "active" : "" ?>">
                        <a href="/kas" class='sidebar-link'>
                            <i class="bi bi-currency-exchange"></i>
                            <span>Kas</span>
                        </a>
                    </li>

                    <li class="sidebar-item <?= $base_path == "/laporan" ? "active" : "" ?> has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-file-earmark-fill"></i>
                            <span>Laporan</span>
                        </a>
                        <ul class="submenu <?= $base_path == "/laporan" ? "active" : "" ?>">
                            <li class="submenu-item <?= $sub_path == "/laporan" ? "active" : "" ?>">
                                <a href="/laporan">Data Laporan</a>
                            </li>
                            <li class="submenu-item <?= $sub_path == "/laporan/anggota" ? "active" : "" ?>">
                                <a href="/laporan/anggota">Anggota</a>
                            </li>   
                            <li class="submenu-item <?= $sub_path == "/laporan/buku" ? "active" : "" ?>">
                                <a href="/laporan/buku">Buku</a>
                            </li>
                            <li class="submenu-item <?= $sub_path == "/laporan/transaksi" ? "active" : "" ?>">
                                <a href="/laporan/transaksi">Transaksi</a>
                            </li>
                            <li class="submenu-item <?= $sub_path == "/laporan/kas" ? "active" : "" ?>">
                                <a href="/laporan/kas">Kas</a>
                            </li>
                            <li class="submenu-item <?= $sub_path == "/laporan/pengguna" ? "active" : "" ?>">
                                <a href="/laporan/pengguna">Pengguna</a>
                            </li>
                         </ul>
                    </li>

                    <li class="sidebar-title">Lainnya</li>

                    <li class="sidebar-item <?= $base_path == "/profil" ? "active" : "" ?> has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-person-fill"></i>
                            <span>Profil</span>
                        </a>
                        <ul class="submenu <?= $base_path == "/profil" ? "active" : "" ?>">
                            <li class="submenu-item <?= $sub_path == "/profil" ? "active" : "" ?>">
                                <a href="/profil">Data Profil</a>
                            </li>
                            <li class="submenu-item <?= $sub_path == "/profil/catatan" ? "active" : "" ?>">
                                <a href="/profil/catatan">Catatan</a>
                            </li>
                         </ul>
                    </li>

                     <li class="sidebar-item <?= $base_path == "/pengguna" ? "active" : "" ?>">
                        <a href="/pengguna" class='sidebar-link'>
                            <i class="bi bi-person-plus-fill"></i>
                            <span>Pengguna</span>
                        </a>
                    </li>

                    <li class="sidebar-item <?= $base_path == "/informasi" ? "active" : "" ?>">
                        <a href="/informasi" class='sidebar-link'>
                            <i class="bi bi-info-circle"></i>
                            <span>Informasi</span>
                        </a>
                    </li>

                    <li class="sidebar-item <?= $base_path == "/pengaturan" ? "active" : "" ?>">
                        <a href="/pengaturan" class='sidebar-link'>
                            <i class="bi bi-gear-fill"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#keluar" class='sidebar-link'>
                            <i class="bi bi-arrow-right"></i>
                            <span>Keluar</span>
                        </a>
                    </li>
                </ul>
            <?php elseif($_SESSION["type"] == "anggota") : ?>
                <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item <?= $base_path == "/dashboard" ? "active" : "" ?>">
                    <a href="/u/anggota/dashboard" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                 <li class="sidebar-item <?= $base_path == "/buku" ? "active" : "" ?>">
                    <a href="/u/anggota/buku" class='sidebar-link'>
                        <i class="bi bi-layers-fill"></i>
                        <span>Buku</span>
                    </a>
                </li>

                <li class="sidebar-item <?= $base_path == "/transaksi" ? "active" : "" ?> has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-arrow-left-right"></i>
                        <span>Transaksi</span>
                    </a>
                    <ul class="submenu <?= $base_path == "/transaksi" ? "active" : "" ?>">
                        <li class="submenu-item <?= $sub_path == "/transaksi" ? "active" : "" ?>">
                            <a href="/u/anggota/transaksi">Data Transaksi</a>
                        </li>
                        <li class="submenu-item <?= $sub_path == "/transaksi/peminjaman" ? "active" : "" ?>">
                            <a href="/u/anggota/transaksi/peminjaman">Peminjaman</a>
                        </li>
                        <li class="submenu-item <?= $sub_path == "/transaksi/denda" ? "active" : "" ?>">
                            <a href="/u/anggota/transaksi/denda">Denda</a>
                        </li>
                     </ul>
                </li>

                <li class="sidebar-title">Lainnya</li>

                <li class="sidebar-item <?= $base_path == "/profil" ? "active" : "" ?> has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-person-fill"></i>
                        <span>Profil</span>
                    </a>
                    <ul class="submenu <?= $base_path == "/profil" ? "active" : "" ?>">
                        <li class="submenu-item <?= $sub_path == "/profil" ? "active" : "" ?>">
                            <a href="/u/anggota/profil">Data Profil</a>
                        </li>
                        <li class="submenu-item <?= $sub_path == "/profil/edit" ? "active" : "" ?>">
                            <a href="/u/anggota/profil/edit">Edit Profil</a>
                        </li>
                     </ul>
                </li>

                <li class="sidebar-item <?= $base_path == "/pengaturan" ? "active" : "" ?>">
                    <a href="/u/anggota/pengaturan" class='sidebar-link'>
                        <i class="bi bi-gear-fill"></i>
                        <span>Pengaturan</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#keluar" class='sidebar-link'>
                        <i class="bi bi-arrow-right"></i>
                        <span>Keluar</span>
                    </a>
                </li>
            </ul>
            <?php endif ?>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="keluar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary py-2">
                <h5 class="modal-title white" id="myModalLabel120">Keluar
                </h5>
                 <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin keluar? Sesi akan dihapus!
            </div>
            <div class="modal-footer">
                <form action="/logout" method="POST">
                    <button type="submit" class="btn btn-primary px-4" data-bs-dismiss="modal">
                        <span class="d-block">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>