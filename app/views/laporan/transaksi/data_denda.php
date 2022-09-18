<?php 
	use Illuminate\Database\Capsule\Manager as Capsule;
	require_once VIEW_PATH . "layouts/laporan/header.php";
?>

<article>
	<h1>Laporan Data Denda</h1>
</article>
<div class="mb-5">
	<div class="mb-3">
		<p>Besaran Denda</p>
		<b><?= rp(first("denda")->besaran_denda) ?> / hari</b>
	</div>
	<div class="mb-3">
		<p>Total Denda Dibayarkan</p>
		<b><?= rp(sum("peminjaman", "denda_dibayarkan")) ?></b>
	</div>
	<div class="mb-3">
		<p>Jumlah Orang Bayar Denda</p>
		<b><?= Capsule::table("peminjaman")->whereRaw("denda_dibayarkan > 0")->count("denda_dibayarkan") ?> orang</b>
	</div>
</div>
<table>
	<thead>
		<tr>
			<th>#</th>
			<th>ID</th>
			<th>Nama Peminjam</th>
			<th>Tanggal Peminjaman</th>
			<th>Batas Pengembalian</th>
			<th>Denda</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count(allWhere("peminjaman", "status", 1)) == 0) : ?>
			<tr>
				<td colspan="100%" style="text-align: center">Tidak ada data</td>
			</tr>
		<?php endif ?>
		 <?php foreach (allWhere("peminjaman", "status", 1) as $key => $peminjaman) : ?>
            	<?php if($peminjaman->denda_dibayarkan > 0) : ?>
					<tr>
						<td><?= $key + 1 ?></td>
						<td><?= codePeminjaman($peminjaman->id) ?></td>
						<td><?= get("anggota", $peminjaman->anggota_id)->nama ?></td>
						<td><?= $peminjaman->tanggal_peminjaman ?></td>
						<td><?= $peminjaman->batas_pengembalian ?></td>
						<td><?= denda($peminjaman->id) ?></td>
						<td>Sudah kembali</td>
					</tr>
				<?php endif ?>
		<?php endforeach ?>
	</tbody>
</table>

<?php
	require_once VIEW_PATH . "layouts/laporan/footer.php";
 ?>
