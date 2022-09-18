<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$breadcrumbs = "
    <li class='breadcrumb-item'><a href='/u/anggota/dashboard'>Dashboard</a></li>
";

$title = "Dashboard";
$subtitle = "Halaman ini berisi rangkuman dari semua informasi yang terdapat di sistem ini.";

require_once VIEW_PATH . "layouts/header.php";
?>

<link rel='stylesheet' href='/mazer/css/shared/iconly.css'>
<?php alertMessage() ?>
<section class="section mb-4">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-3">
                    <p class="mb-0">
                        Total Peminjaman Anda
                    </p>
                </div>
                <div class="card-body">
                    <h4 class="mb-0"><?= amountWhere("peminjaman", "anggota_id", auth()->id) ?> kali</h3>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-3">
                    <p class="mb-0">
                        Buku Dipinjam
                    </p>
                </div>
                <div class="card-body">
                    <h4 class="mb-0"><?= Capsule::table("detail_peminjaman")->whereIn("peminjaman_id", pluck("peminjaman", "anggota_id", auth()->id, "id"))->sum("jumlah_buku") ?> buah</h3>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card">
                <div class="card-header pb-3">
                    <p class="mb-0">
                        Buku Dikembalikan
                    </p>
                </div>
                <div class="card-body">
                    <h4 class="mb-0"><?= Capsule::table("detail_peminjaman")->where("status", 1)->whereIn("peminjaman_id", pluck("peminjaman", "anggota_id", auth()->id, "id"))->sum("jumlah_buku") ?> buah</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <h4>Data Peminjaman Buku</h4>
                </div>
                <div class="card-body">
                    <div id="chart-peminjaman-bulanan"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src='/mazer/js/extensions/apexcharts/apexcharts.min.js'></script>
<script type="text/javascript">
    async function getPeminjamanBulananAnggota(){
      const response = await fetch(`${window.location.origin}/api/peminjaman_bulanan_anggota`)
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

    getPeminjamanBulananAnggota()

</script>

<?php require_once VIEW_PATH . "layouts/footer.php" ?>