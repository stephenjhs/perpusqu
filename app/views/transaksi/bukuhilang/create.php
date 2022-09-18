<?php

$sub_path = "/transaksi/bukuhilang";

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/transaksi'>Transaksi</a></li>
    <li class='breadcrumb-item'><a href='/transaksi/bukuhilang'>Buku Hilang</a></li>
    <li class='breadcrumb-item'><a href='/transaksi/bukuhilang/create'>Tambah Data</a></li>
";

$title = "Tambah Data Buku Hilang";
$subtitle = "Halaman ini digunakan untuk menambah data buku hilang.";

require_once VIEW_PATH . "layouts/header.php";
?>

<?php alertMessage() ?>
<section class="section mb-4">
    <div class="card">
        <div class="card-header pb-2 d-flex justify-content-between align-items-center">
            <p class="mb-0">
                Form Tambah Data
            </p>
            <div class="badge bg-light-success">
                <?= codeBukuHilang() ?>
            </div>
        </div>
        <hr class="mx-4">
        <div class="card-content">
            <div class="card-body">
                <form action="/transaksi/bukuhilang/store" method="POST">
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label for="buku" class="mb-2">Buku <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Text</span>
                                <select class="form-select <?= error("buku_id") ?>" id="buku" name="buku_id">
                                    <option class="buku" value="" selected>Pilih Buku</option>
                                    <?php foreach (all("buku") as $buku) : ?>
                                        <option data-jumlah_buku="<?= $buku->jumlah_buku ?> buah" data-harga="<?= $buku->harga ?>" class="buku" value="<?= $buku->id ?>" <?= old("buku_id") == $buku->id ? "selected" : "" ?>><?= $buku->judul ?></option>
                                    <?php endforeach ?>
                                </select>
                                <?php errorMessage("buku_id") ?>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label for="jumlah_buku" class="mb-2">Jumlah Buku <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">#</span>
                                <input type="number" name="jumlah_buku" id="jumlah_buku" class="form-control <?= error("jumlah_buku") ?>" placeholder="Masukkan jumlah buku..." value="<?= old("jumlah_buku") ?>">
                                <?php errorMessage("jumlah_buku") ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label for="harga" class="mb-2">Harga <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">#</span>
                                <input type="number" name="harga" id="harga" class="harga form-control <?= error("harga") ?>" placeholder="Masukkan harga..." value="<?= old("harga") ?>">
                                <?php errorMessage("harga") ?>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label class="mb-2">Jumlah Buku Di Rak</label>
                            <div class="input-group">
                                <input readonly name="jumlah_buku_rak" class="jumlah-buku form-control" value="<?= old("jumlah_buku_rak") ?>" placeholder="Inputan anda akan muncul disini.">
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label for="status" class="mb-2">Status <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Text</span>
                                <select class="form-select <?= error("status") ?>" id="status" name="status">
                                    <option value="" selected>Pilih Status</option>
                                    <option value="0" <?= old("status") == "0" ? "selected" : "" ?>>Belum dibayar</option>
                                    <option value="1" <?= old("status") == "1" ? "selected" : "" ?>>Sudah dibayar</option>
                                </select>
                                <?php errorMessage("status") ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-4">
                            <label for="keterangan" class="mb-2">Keterangan</label>
                            <div class="form-group ">
                                <textarea class="form-control" name="keterangan" id="keterangan" style="height: 150px;" placeholder="Masukkan keterangan..."><?= old("keterangan") ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg mb-4">
                            <label class="mb-2">Tanggal</label>
                            <div class="input-group">
                                <input readonly value="<?= date("Y-m-d") ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto ms-auto">
                            <button type="reset" class="btn px-4">Reset</button>
                            <button type="submit" class="btn btn-primary px-4">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    const bukuEls = document.querySelectorAll(".buku")
    const hargaEl = document.querySelector(".harga")
    const jumlahBukuEl = document.querySelector(".jumlah-buku")
    bukuEls.forEach(item => {
        item.addEventListener("click", function() {
            if(Object.keys(event.target.dataset).length == 0) {
                hargaEl.value = ``
                jumlahBukuEl.value = ``
            } else {
                hargaEl.value = event.target.dataset.harga
                jumlahBukuEl.value = `${event.target.dataset.jumlah_buku}`
            }
            
        })
    })
</script>

<?php require_once VIEW_PATH . "layouts/footer.php" ?>