<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$sub_path = "/transaksi/bukuhilang";

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/transaksi'>Transaksi</a></li>
    <li class='breadcrumb-item'><a href='/transaksi/bukuhilang'>Buku Hilang</a></li>
";

$title = "Data Buku Hilang";
$subtitle = "Berisi informasi lengkap tentang buku hilang.";

require_once VIEW_PATH . "layouts/header.php";
?>

<link rel='stylesheet' href='/mazer/css/pages/simple-datatables.css'>
<?php alertMessage() ?>
<section class="section mb-4">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-3">
                    <p class="mb-0">
                        Jumlah Buku Yang Hilang
                    </p>
                </div>
                <div class="card-body">
                   <h4 class="mb-0"><?= sum("buku_hilang", "jumlah_buku") ?> buah</h3>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-3">
                    <p class="mb-0">
                        Total Ganti Rugi Dibayarkan
                    </p>
                </div>
                <div class="card-body">
                   <h4 class="mb-0"><?= rp(Capsule::table("buku_hilang")->selectRaw("SUM(jumlah_buku * harga) AS total_kerugian")->where("status", 1)->first()->total_kerugian) ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header pb-2 d-flex justify-content-between align-items-center">
            <p class="mb-0">
                Tabel Data
            </p>
            <a href="/transaksi/bukuhilang/create" class="btn btn-primary px-4">Tambah Data</a>
        </div>
        <hr class="mx-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr class="text-nowrap">
                            <th>ID</th>
                            <th>Judul Buku</th>
                            <th>Jumlah Buku</th>
                            <th>Total Kerugian</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (all("buku_hilang") as $buku_hilang) : ?>
                            <tr class="text-nowrap">
                                <td><?= codeBukuHilang($buku_hilang->id) ?></td>
                                <td><?= get("buku", $buku_hilang->buku_id)->judul ?></td>
                                <td><?= $buku_hilang->jumlah_buku ?></td>
                                <td><?= rp($buku_hilang->harga * $buku_hilang->jumlah_buku) ?></td>
                                <td><?= $buku_hilang->tanggal ?></td>
                                <td>
                                    <?php if($buku_hilang->status == 0) : ?>
                                        <a href="#" class="badge bg-danger text-white" data-bs-toggle="modal" data-bs-target="#bayarkerugian<?= $buku_hilang->id ?>">Belum dibayar</a>
                                    <?php else : ?>
                                        <div class="badge bg-success">Sudah dibayar</div>
                                    <?php endif ?>
                                </td>
                                <td>
                                    <a href="#" class="badge bg-info text-black me-1" data-bs-toggle="modal" data-bs-target="#detail<?= $buku_hilang->id ?>">Detail</a>
                                    <a href="#" class="badge bg-danger text-white me-1" data-bs-toggle="modal" data-bs-target="#hapus<?= $buku_hilang->id ?>">Hapus</a>
                                </td>
                                <div class="modal fade text-left" id="hapus<?= $buku_hilang->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger py-2">
                                                <h5 class="modal-title white" id="myModalLabel120">Hapus buku hilang
                                                </h5>
                                                 <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus <b><?= codeBukuHilang($buku_hilang->id) ?></b>? Data yang sudah dihapus tidak dapat dikembalikan!
                                            </div>
                                            <div class="modal-footer">
                                                <form action="/transaksi/bukuhilang/delete" method="POST">
                                                    <input hidden name="id" value="<?= $buku_hilang->id ?>">
                                                    <button type="submit" class="btn btn-danger px-4" data-bs-dismiss="modal">
                                                        <span class="d-block">Hapus</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade text-left" id="detail<?= $buku_hilang->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary py-2">
                                                <h5 class="modal-title white" id="myModalLabel120">Detail buku hilang
                                                </h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="row">
                                                    <div class="col-lg">
                                                        <ul class="list-group">
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">ID</div>
                                                                <div class="badge bg-success"><?= codeBukuHilang($buku_hilang->id) ?></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Judul Buku</div>
                                                                <div><b><?= get("buku", $buku_hilang->buku_id)->judul ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Jumlah Buku</div>
                                                                <div><b><?= $buku_hilang->jumlah_buku ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Harga Buku</div>
                                                                <div><b><?= rp($buku_hilang->harga) ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Total Kerugian</div>
                                                                <div><b><?= rp($buku_hilang->harga * $buku_hilang->jumlah_buku) ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Keterangan</div>
                                                                <div><b><?= $buku_hilang->keterangan ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Status</div>
                                                                <div>
                                                                    <?php if($buku_hilang->status == 0) : ?>
                                                                        <a href="#" class="badge bg-danger text-white" data-bs-toggle="modal" data-bs-target="#bayarkerugian<?= $buku_hilang->id ?>">Belum dibayar</a>
                                                                    <?php else : ?>
                                                                        <div class="badge bg-success">Sudah dibayar</div>
                                                                    <?php endif ?>
                                                                </div>
                                                            </li>
                                                            <hr>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Jumlah Buku Di Rak</div>
                                                                <div><b><?= get("buku", $buku_hilang->buku_id)->jumlah_buku ?></b></div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if($buku_hilang->status == 0) : ?>
                                    <div class="modal fade text-left" id="bayarkerugian<?= $buku_hilang->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary py-2">
                                                    <h5 class="modal-title white" id="myModalLabel120">Bayar kerugian
                                                    </h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <div class="alert alert-info text-black">
                                                        Total kerugian : <?= rp($buku_hilang->harga * $buku_hilang->jumlah_buku) ?> 
                                                    </div>
                                                    Klik proses untuk membayar lunas kerugian!
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="/transaksi/bukuhilang/bayarkerugian" method="POST">
                                                        <input hidden name="id" value="<?= $buku_hilang->id ?>">
                                                        <div class="row">
                                                            <div class="col-auto ms-auto">
                                                                <button type="submit" class="btn btn-primary px-4">Proses</button>
                                                            </div>
                                                        </div>
                                                  </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script src='/mazer/js/extensions/simple-datatables.js'></script>

<?php require_once VIEW_PATH . "layouts/footer.php" ?>