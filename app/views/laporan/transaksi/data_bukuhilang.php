<?php 
	use Illuminate\Database\Capsule\Manager as Capsule;
	require_once VIEW_PATH . "layouts/laporan/header.php";
?>

<article>
	<h1>Laporan Data Buku Hilang</h1>
</article>
<div class="mb-5">
	<div class="mb-3">
		<p>Jumlah Buku Yang Hilang</p>
		<b><?= sum("buku_hilang", "jumlah_buku") ?> buah</b>
	</div>
	<div class="mb-3">
		<p>Total Ganti Rugi Dibayarkan</p>
		<b><?= rp(Capsule::table("buku_hilang")->selectRaw("SUM(jumlah_buku * harga) AS total_kerugian")->where("status", 1)->first()->total_kerugian) ?></b>
	</div>
</div>
<table>
	<thead>
		<tr>
			<th>#</th>
			<th>ID</th>
			<th>Judul Buku</th>
			<th>Jumlah Buku</th>
			<th>Total Kerugian</th>
			<th>Tanggal</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count(all("buku_hilang")) == 0) : ?>
			<tr>
				<td colspan="100%" style="text-align: center">Tidak ada data</td>
			</tr>
		<?php endif ?>
		 <?php foreach (all("buku_hilang") as $key => $buku_hilang) : ?>
			<tr>
				<td><?= $key + 1 ?></td>
				<td><?= codeBukuHilang($buku_hilang->id) ?></td>
				<td><?= get("buku", $buku_hilang->buku_id)->judul ?></td>
				<td><?= $buku_hilang->jumlah_buku ?> buah</td>
				<td><?= rp($buku_hilang->harga * $buku_hilang->jumlah_buku) ?></td>
				<td><?= $buku_hilang->tanggal ?></td>
				<td>
					<?php if($buku_hilang->status == 0) : ?>
						Belum dibayar
                    <?php else : ?>
                    	Sudah dibayar
                    <?php endif ?>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<?php
	require_once VIEW_PATH . "layouts/laporan/footer.php";
 ?>
