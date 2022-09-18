<?php 
	use Illuminate\Database\Capsule\Manager as Capsule;
	require_once VIEW_PATH . "layouts/laporan/header.php";

	$data = Capsule::table("kas")->whereBetween("tanggal", [$tanggal_awal, $tanggal_akhir]);
	if($tipe_kas != "") {
		$data = $data->where("tipe_kas", $tipe_kas)->orderBy("id", "DESC")->get();
	} else {
		$data = $data->orderBy("id", "DESC")->get();
	}
?>

<article>
	<h1>Laporan Data Kas</h1>
	<p>Dari tanggal <b><?= $tanggal_awal ?></b> s/d tanggal <b><?= $tanggal_akhir ?></b></p>
</article>
<div class="mb-5">
	<div class="mb-3">
		<p>Total Kas</p>
		<b><?= rp(sumWhere("kas", "tipe_kas", "pemasukan", "besaran_kas") - sumWhere("kas", "tipe_kas", "pengeluaran", "besaran_kas")) ?></b>
	</div>
	<div class="mb-3">
		<p>Total Pemasukan</p>
		<b><?= rp(sumWhere("kas", "tipe_kas", "pemasukan", "besaran_kas")) ?></b>
	</div>
	<div class="mb-3">
		<p>Total Pengeluaran</p>
		<b><?= rp(sumWhere("kas", "tipe_kas", "pengeluaran", "besaran_kas")) ?></b>
	</div>
</div>
<table>
	<thead>
		<tr>
			<th>#</th>
			<th>ID</th>
			<th>Besaran Kas</th>
			<th>Keterangan</th>
			<th>Tanggal</th>
			<th>Tipe Kas</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count($data) == 0) : ?>
			<tr>
				<td colspan="100%" style="text-align: center">Tidak ada data</td>
			</tr>
		<?php endif ?>
		 <?php foreach ($data as $key => $kas) : ?>
			<tr>
				<td><?= $key + 1 ?></td>
				<td><?= codeKas($kas->id) ?></td>
                <td><?= rp($kas->besaran_kas) ?></td>
                <td><?= $kas->keterangan ?></td>
                <td><?= $kas->tanggal ?></td>
                <td>
                	<?php if ($kas->tipe_kas == "pemasukan") : ?>
                        Pemasukan
                    <?php else : ?>
                        Pengeluaran
                    <?php endif ?>
                </td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<?php
	require_once VIEW_PATH . "layouts/laporan/footer.php";
 ?>
