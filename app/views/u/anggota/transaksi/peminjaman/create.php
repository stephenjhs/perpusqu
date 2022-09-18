<?php

$sub_path = "/transaksi/peminjaman";

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/u/anggota/transaksi'>Transaksi</a></li>
    <li class='breadcrumb-item'><a href='/u/anggota/transaksi/peminjaman'>Peminjaman</a></li>
";

$title = "Tambah Data Peminjaman";
$subtitle = "Halaman ini digunakan untuk menambah data peminjaman.";

require_once VIEW_PATH . "layouts/header.php";
?>

<link rel='stylesheet' href='/mazer/css/pages/simple-datatables.css'>
<?php alertMessage() ?>
<section class="section mb-4">
    <div class="card">
        <div class="card-header pb-2 d-flex justify-content-between align-items-center">
            <p class="mb-0">
                Form Tambah Data
            </p>
            <div class="badge bg-light-success">
                <?= codePeminjaman() ?>
            </div>
        </div>
        <hr class="mx-4">
        <div class="card-content">
            <div class="card-body">
                <form action="/u/anggota/transaksi/peminjaman/store" method="POST">
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label class="mb-2">Tanggal Peminjaman</label>
                            <div class="input-group">
                                <input readonly value="<?= date("Y-m-d") ?>" class="form-control">
                            </div>
                        </div>
                         <div class="col-lg mb-4">
                            <label for="denda" class="mb-2">Denda</label>
                            <div class="input-group">
                                <span class="input-group-text">#</span>
                                <input readonly value="<?= first("denda")->besaran_denda ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label for="batas_pengembalian" class="mb-2">Batas Pengembalian</label>
                            <div class="input-group">
                                <span class="input-group-text">Date</span>
                                <input readonly value="<?= date("Y-m-d", time() + 604800) ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label class="mb-2">Daftar Buku <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Search</span>
                                <input readonly class="form-control cari-buku" placeholder="Cari Buku">
                                <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#buku">
                                    <i class="bi bi-search" style="margin-top: -7px"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label class="mb-2">Nama Anggota</label>
                            <div class="input-group">
                                <input readonly value="<?= auth()->nama ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div id="book-content"></div>
                    <hr>
                    <div class="row">
                        <div class="col-auto ms-auto">
                            <button type="reset" class="btn px-4">Reset</button>
                            <button type="submit" class="btn btn-primary px-4">Tambah</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</section>

<div class="modal fade text-left" id="buku" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary py-2">
                <h5 class="modal-title white" id="myModalLabel120">Tambah Buku
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr class="text-nowrap">
                                <th>ID</th>
                                <th>ISBN</th>
                                <th>Judul</th>
                                <th>Jumlah Buku</th>
                                <th>Dibuat Pada</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (all("buku") as $buku) : ?>
                                <tr class="text-nowrap">
                                    <td><?= codeAnggota($buku->id) ?></td>
                                    <td><?= $buku->isbn ?></td>
                                    <td><?= $buku->judul ?></td>
                                    <td><?= $buku->jumlah_buku ?></td>
                                    <td><?= timeago("@" . $buku->dibuat_pada) ?></td>
                                    <td>
                                        <a href="#" class="badge bg-success text-white me-1 select-book" data-bs-dismiss="modal" data-code="<?= codeBuku($buku->id) ?>" data-buku='<?= allWhere("buku", "id", $buku->id) ?>'>Pilih</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const bookContentEl = document.querySelector("#book-content")
    const cariBukuEl = document.querySelector(".cari-buku")
    let allBook = []

    window.addEventListener("click", () => {
        const el = event.target

        if(el.classList.contains("batal")) {
            const id = el.dataset.id
            allBook = allBook.filter(item => item != id)
            const daftarEl = document.querySelector(`#daftar${id}`)
            bookContentEl.removeChild(daftarEl)
        }

        if(el.classList.contains("select-book")) {
            const { id, isbn, judul } = JSON.parse(el.dataset.buku)[0]
            const code = el.dataset.code 

            if(!allBook.includes(id)) {
                cariBukuEl.value = code
                bookContentEl.insertAdjacentHTML("beforeend", `
                    <div class="row align-items-end" id="daftar${id}">
                        <input hidden name="buku_id[]" value="${id}">
                        <div class="col-lg mb-4">
                            <label class="mb-2">ISBN</label>
                            <div class="input-group">
                                <input readonly value="${isbn}" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label class="mb-2">Judul</label>
                            <div class="input-group">
                                <input readonly value="${judul}" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label class="mb-2" for="jumlah_buku">Jumlah Buku <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input name="jumlah_buku[]" type="number" id="jumlah_buku" placeholder="Masukkan Jumlah Buku" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-auto mb-4">
                            <div class="btn btn-danger px-4 batal" data-id="${id}">
                                Batal
                            </div>
                        </div>
                    </div>
                `)
                allBook.push(id)
            } 
        }
    })
</script>
<script src='/mazer/js/extensions/simple-datatables.js'></script>

<?php require_once VIEW_PATH . "layouts/footer.php" ?>
