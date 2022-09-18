<?php 
	require_once VIEW_PATH . "layouts/laporan/header.php";
?>

<article>
	<h1>Laporan Data Kategori</h1>
</article>
<table>
	<thead>
		<tr>
			<th>#</th>
			<th>ID</th>
			<th>Nama Kategori</th>
			<th>Jumlah Buku</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count(all("kategori_buku")) == 0) : ?>
			<tr>
				<td colspan="100%" style="text-align: center">Tidak ada data</td>
			</tr>
		<?php endif ?>
		<?php foreach (all("kategori_buku") as $key => $kategori) : ?>
			<tr>
				<td><?= $key + 1 ?></td>
				<td><?= codeKategori($kategori->id) ?></td>
				<td><?= $kategori->nama_kategori ?></td>
				<td><?= amountWhere("buku", "kategori_id", $kategori->id) ?> buah</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<?php
	require_once VIEW_PATH . "layouts/laporan/footer.php";
 ?>
