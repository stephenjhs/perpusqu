<?php

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/dashboard'>Dashboard</a></li>
";

$title = "Dashboard";
$subtitle = "Halaman ini berisi rangkuman dari semua informasi yang terdapat di sistem ini.";

require_once VIEW_PATH . "layouts/header.php";
?>

<link rel="stylesheet" href="/mazer/css/shared/iconly.css">
<?php alertMessage() ?>
<section class="section mb-4">
    <div class="row">
        <div class="col-lg">
            <a href="/" class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon green">
                                <i class="iconly-boldUser1"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Anggota</h6>
                            <h6 class="font-extrabold mb-0"><?= amount("anggota") ?> orang</h6>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg">
            <a href="/" class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon blue">
                                <i class="iconly-boldBookmark"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Buku</h6>
                            <h6 class="font-extrabold mb-0"><?= sum("buku", "jumlah_buku") ?> buah</h6>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg">
            <a href="/" class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon red">
                                <i class="iconly-boldSwap"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Transaksi</h6>
                            <h6 class="font-extrabold mb-0"><?= amount("peminjaman") ?> kali</h6>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg">
            <a href="/" class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon purple">
                                <i class="iconly-boldUser"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Petugas</h6>
                            <h6 class="font-extrabold mb-0"><?= amount("pengguna") ?> orang</h6>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>Data Peminjaman Buku</h4>
                </div>
                <div class="card-body">
                    <div id="chart-peminjaman-bulanan"></div>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <h4>Kuantitas Buku</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex mb-3">
                            <div class="col-lg" style="max-width: 250px">Total Buku</div>
                            <div><?= sum("buku", "jumlah_buku") + sum("buku_hilang", "jumlah_buku") + sum("detail_peminjaman", "jumlah_buku") ?> buah</div>
                        </li>
                        <li class="list-group-item d-flex">
                            <div class="col-lg" style="max-width: 250px">Buku Hilang</div>
                            <div><?= sum("buku_hilang", "jumlah_buku") ?> buah</div>
                        </li>
                        <li class="list-group-item d-flex">
                            <div class="col-lg" style="max-width: 250px">Buku Dipinjam</div>
                            <div><?= sum("detail_peminjaman", "jumlah_buku") ?> buah</div>
                        </li>
                        <li class="list-group-item d-flex">
                            <div class="col-lg" style="max-width: 250px">Buku Aman</div>
                            <div><?= sum("buku", "jumlah_buku") ?> buah</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg">
             <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Pengguna Yang Online</h4>
                    <div class="badge bg-info text-black"><?= amount("online") ?> orang</div>
                </div>
                 <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (amount("online") == 0) : ?>
                                    <tr class="text-nowrap">
                                        <td colspan="100%" style="text-align: center;">Data tidak ada</td>
                                    </tr>
                                <?php endif ?>
                                <?php foreach (allLimit("online", 5) as $key => $online) : ?>
                                    <tr class="text-nowrap">
                                        <td><?= $key + 1 ?></td>
                                        <td><?= get($online->type, $online->login_id)->nama ?></td>
                                        <td><div class="badge bg-success">Online</div></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg">
             <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Notifikasi</h4>
                    <div class="badge bg-info text-black"><?= amount("notifikasi") ?> pemberitahuan</div>
                </div>
                 <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>#</th>
                                    <th>Isi Notifikasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (amount("notifikasi") == 0) : ?>
                                    <tr class="text-nowrap">
                                        <td colspan="100%" style="text-align: center;">Data tidak ada</td>
                                    </tr>
                                <?php endif ?>
                                <?php foreach (allLimit("notifikasi", 5) as $key => $notifikasi) : ?>
                                    <tr class="text-nowrap">
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $notifikasi->isi_notifikasi ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-3">
                    <p class="mb-0">
                        Total Kas
                    </p>
                </div>
                <div class="card-body">
                    <h4 class="mb-0"><?= rp(sumWhere("kas", "tipe_kas", "pemasukan", "besaran_kas") - sumWhere("kas", "tipe_kas", "pengeluaran", "besaran_kas")) ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-3">
                    <p class="mb-0">
                        Total Pemasukan
                    </p>
                </div>
                <div class="card-body">
                    <h4 class="mb-0"><?= rp(sumWhere("kas", "tipe_kas", "pemasukan", "besaran_kas")) ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-3">
                    <p class="mb-0">
                        Total Pengeluaran
                    </p>
                </div>
                <div class="card-body">
                    <h4 class="mb-0"><?= rp(sumWhere("kas", "tipe_kas", "pengeluaran", "besaran_kas")) ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-2 d-flex justify-content-between align-items-center">
                    <p class="mb-0">
                        Data Anggota
                    </p>
                    <a href="/anggota" class="badge bg-info text-black">
                        Lihat
                    </a>
                </div>
                <hr class="mx-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Dibuat Pada</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (amount("anggota") == 0) : ?>
                                    <tr class="text-nowrap">
                                        <td colspan="100%" style="text-align: center;">Data tidak ada</td>
                                    </tr>
                                <?php endif ?>
                                <?php foreach (allLimit("anggota", 5) as $anggota) : ?>
                                    <tr class="text-nowrap">
                                        <td><?= codeAnggota($anggota->id) ?></td>
                                        <td><?= $anggota->nama ?></td>
                                        <td><?= timeago("@" . $anggota->dibuat_pada) ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-2 d-flex justify-content-between align-items-center">
                    <p class="mb-0">
                        Data Buku
                    </p>
                    <a href="/buku" class="badge bg-info text-black">
                        Lihat
                    </a>
                </div>
                <hr class="mx-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>ID</th>
                                    <th>Judul</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (amount("buku") == 0) : ?>
                                    <tr class="text-nowrap">
                                        <td colspan="100%" style="text-align: center;">Data tidak ada</td>
                                    </tr>
                                <?php endif ?>
                                <?php foreach (allLimit("buku", 5) as $buku) : ?>
                                    <tr class="text-nowrap">
                                        <td><?= codeBuku($buku->id) ?></td>
                                        <td><?= $buku->judul ?></td>
                                        <td><?= $buku->jumlah_buku ?> buah</td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src='/mazer/js/extensions/apexcharts/apexcharts.min.js'></script>
<script type="text/javascript">
    async function getPeminjamanBulanan(){
      const response = await fetch(`${window.location.origin}/api/peminjaman_bulanan`)
      const data = await response.json()
      
      let peminjaman_bulanan = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
      data.map(item => peminjaman_bulanan[item.bulan - 1] = item.total_buku)

      const optionsPeminjamanBulanan = {
        annotations: {
            position: "back"
        },
        dataLabels: {
            enabled: !1
        },
        chart: {
            type: "bar",
            height: 300
        },
        fill: {
            opacity: 1
        },
        plotOptions: {},
        series: [{
            name: "peminjaman",
            data: peminjaman_bulanan
        }],
        colors: "#435ebe",
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"]
        }
    }
        const chartPeminjamanBulanan = new ApexCharts(document.querySelector("#chart-peminjaman-bulanan"), optionsPeminjamanBulanan)
        chartPeminjamanBulanan.render()
    }

    getPeminjamanBulanan()
</script>

<?php require_once VIEW_PATH . "layouts/footer.php" ?>