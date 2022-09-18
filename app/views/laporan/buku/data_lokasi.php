<?php 
	require_once VIEW_PATH . "layouts/laporan/header.php";
?>

<article>
	<h1>Laporan Data Lokasi</h1>
</article>
<table>
	<thead>
		<tr>
			<th>#</th>
			<th>ID</th>
			<th>Nama Lokasi</th>
			<th>Jumlah Buku</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count(all("lokasi_buku")) == 0) : ?>
			<tr>
				<td colspan="100%" style="text-align: center">Tidak ada data</td>
			</tr>
		<?php endif ?>
		<?php foreach (all("lokasi_buku") as $key => $lokasi) : ?>
			<tr>
				<td><?= $key + 1 ?></td>
				<td><?= codeLokasi($lokasi->id) ?></td>
				<td><?= $lokasi->nama_lokasi ?></td>
				<td><?= amountWhere("buku", "lokasi_id", $lokasi->id) ?> buah</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<?php
	require_once VIEW_PATH . "layouts/laporan/footer.php";
 ?>
