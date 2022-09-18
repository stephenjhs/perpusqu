<?php

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/u/anggota/buku'>Buku</a></li>
";

$title = "Data Buku";
$subtitle = "Halaman digunakan untuk melihat data buku.";

require_once VIEW_PATH . "layouts/header.php";
?>

<link rel='stylesheet' href='/mazer/css/pages/simple-datatables.css'>
<?php alertMessage() ?>
<section class="section mb-4">
    <div class="card">
        <div class="card-header pb-2 d-flex justify-content-between align-items-center">
            <p class="mb-0">
                Tabel Data
            </p>
            <div class="badge bg-info text-black"><?= sum("buku", "jumlah_buku") ?> buah</div>
        </div>
        <hr class="mx-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr class="text-nowrap">
                            <th>ID</th>
                            <th>ISBN</th>
                            <th>Judul</th>
                            <th>Jumlah Buku</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Dibuat Pada</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (all("buku") as $buku) : ?>
                            <tr class="text-nowrap">
                                <td><?= codeBuku($buku->id) ?></td>
                                <td><?= $buku->isbn ?></td>
                                <td><?= $buku->judul ?></td>
                                <td><?= $buku->jumlah_buku ?></td>
                                <td><?= get("kategori_buku", $buku->kategori_id)->nama_kategori ?></td>
                                <td><?= get("lokasi_buku", $buku->lokasi_id)->nama_lokasi ?></td>
                                <td><?= timeago("@" . $buku->dibuat_pada) ?></td>
                                <td>
                                    <a href="#" class="badge bg-info text-black me-1" data-bs-toggle="modal" data-bs-target="#detail<?= $buku->id ?>">Detail</a>
                                </td>
                                <div class="modal fade text-left" id="detail<?= $buku->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary py-2">
                                                <h5 class="modal-title white" id="myModalLabel120">Detail buku
                                                </h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="row">
                                                    <div class="col-lg-3 -me-2">
                                                        <img src="/images/<?= $buku->sampul ?>" class="image-detail" alt="">
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <ul class="list-group">
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">ID</div>
                                                                <div class="badge bg-success"><?= codeBuku($buku->id) ?></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">ISBN</div>
                                                                <div><b><?= $buku->isbn ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Judul</div>
                                                                <div><b><?= $buku->judul ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Pengarang</div>
                                                                <div><b><?= $buku->pengarang ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Penerbit</div>
                                                                <div><b><?= $buku->penerbit ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Tahun Terbit</div>
                                                                <div><b><?= $buku->tahun_terbit ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Jumlah Buku</div>
                                                                <div><b><?= $buku->jumlah_buku ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Kategori</div>
                                                                <div><b><?= get("kategori_buku", $buku->kategori_id)->nama_kategori ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Lokasi</div>
                                                                <div><b><?= get("lokasi_buku", $buku->lokasi_id)->nama_lokasi ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Total Halaman</div>
                                                                <div><b><?= $buku->total_halaman ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Harga</div>
                                                                <div><b><?= rp($buku->harga) ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Keterangan</div>
                                                                <div><b><?= $buku->keterangan ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Peminat</div>
                                                                <div><b><?= $buku->peminat ?> orang</b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Dibuat Pada</div>
                                                                <div><b><?= timeago("@" . $buku->dibuat_pada) ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Terakhir Diedit</div>
                                                                <div><b><?= timeago("@" . $buku->diedit_pada) ?></b></div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Buku Dipinjam</div>
                                                                <div>
                                                                    <b><?= sumWhere("detail_peminjaman", "buku_id", $buku->id, "jumlah_buku") ?> buah</b>
                                                                </div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="col-lg-4">Buku Hilang</div>
                                                                <div>
                                                                    <b><?= sumWhere("buku_hilang", "buku_id", $buku->id, "jumlah_buku") ?> buah</b>
                                                                </div>
                                                            </li>
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