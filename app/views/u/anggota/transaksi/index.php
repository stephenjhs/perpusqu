<?php

$sub_path = "/transaksi";

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/transaksi'>Transaksi</a></li>
";

$title = "Daftar Peminjaman Buku";
$subtitle = "Lihat daftar peminjaman buku anda di halaman ini.";

require_once VIEW_PATH . "layouts/header.php";
?>

<link rel='stylesheet' href='/mazer/css/pages/simple-datatables.css'>
<?php alertMessage() ?>
<section class="section mb-4">
    <div class="card">
        <div class="card-header pb-2">
            <p class="mb-0">
                Tabel Data
            </p>
        </div>
        <hr class="mx-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr class="text-nowrap">
                            <th>ID</th>
                            <th>Nama Peminjam</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Batas Pengembalian</th>
                            <th>Total Denda</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (allWhere("peminjaman", "anggota_id", auth()->id) as $peminjaman) : ?>
                            <tr class="text-nowrap">
                                <td><?= codePeminjaman($peminjaman->id) ?></td>
                                <td><?= get("anggota", $peminjaman->anggota_id)->nama ?></td>
                                <td><?= $peminjaman->tanggal_peminjaman ?></td>
                                <td><?= $peminjaman->batas_pengembalian ?></td>
                                <td><?= denda($peminjaman->id) ?></td>
                                <td><?= statusPeminjamanDisplay($peminjaman->id) ?></td>
                                <td>
                                    <a href="#" class="badge bg-info text-black me-1" data-bs-toggle="modal" data-bs-target="#detail<?= $peminjaman->id ?>">Detail</a>
                                </td>
                                <div class="modal fade text-left" id="detail<?= $peminjaman->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary py-2">
                                                <h5 class="modal-title white" id="myModalLabel120">Detail peminjaman
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
                                                                <div class="badge bg-success"><?= codePeminjaman($peminjaman->id) ?></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Nama Peminjam</div>
                                                                <div><b><?= get("anggota", $peminjaman->anggota_id)->nama ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Nama Petugas</div>
                                                                <div>
                                                                    <?php if($peminjaman->pengguna_id == null) : ?>
                                                                        <b>Ditambahkan oleh anggota</b>
                                                                    <?php else : ?>
                                                                        <b><?= get("pengguna", $peminjaman->pengguna_id)->nama ?></b>
                                                                    <?php endif ?>
                                                                </div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Tanggal Peminjaman</div>
                                                                <div><b><?= $peminjaman->tanggal_peminjaman ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Batas Pengembalian</div>
                                                                <div><b><?= $peminjaman->batas_pengembalian ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Denda</div>
                                                                <div><b><?= rp($peminjaman->denda) ?> / hari</b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Total Denda</div>
                                                                <div><b><?= denda($peminjaman->id, $peminjaman->batas_pengembalian) ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Denda Dibayarkan</div>
                                                                <div><b><?= rp($peminjaman->denda_dibayarkan) ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Status</div>
                                                                <div><b><?= statusPeminjamanDisplay($peminjaman->id) ?></b></div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-lg">
                                                        <ul class="list-group">
                                                            <li class="list-group-item d-flex fw-bold">
                                                                <div class="pe-5">#</div>
                                                                <div class="col-lg-5 pe-5">Judul Buku</div>
                                                                <div class="col-lg">Jumlah Buku</div>
                                                                <div class="col-lg">Status</div>
                                                                <div class="col-lg">Dikembalikan</div>
                                                            </li>
                                                            <?php foreach (allWhere("detail_peminjaman", "peminjaman_id", $peminjaman->id) as $key => $detail_peminjaman) : ?>
                                                                <li class="list-group-item d-flex">
                                                                    <div class="pe-5"><?= $key + 1 ?></div>
                                                                    <div class="col-lg-5 pe-5"><?= get("buku", $detail_peminjaman->buku_id)->judul ?></div>
                                                                    <div class="col-lg"><?= $detail_peminjaman->jumlah_buku ?> buah</div>
                                                                    <div class="col-lg"><?= statusDetailPeminjaman($detail_peminjaman->id) ?></div>
                                                                    <div class="col-lg">
                                                                        <?php if ($detail_peminjaman->status == 0) : ?>
                                                                            -
                                                                        <?php else : ?>
                                                                            <?= $detail_peminjaman->tanggal_dikembalikan ?>
                                                                        <?php endif ?>
                                                                    </div>
                                                                </li>
                                                            <?php endforeach ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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