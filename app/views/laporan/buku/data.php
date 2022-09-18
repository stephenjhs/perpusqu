<?php 
	require_once VIEW_PATH . "layouts/laporan/header.php";
?>

<article>
	<h1>Laporan Data Buku</h1>
	<p>Dari tanggal <b><?= date("d-m-Y", $tanggal_awal) ?></b> s/d tanggal <b><?= date("d-m-Y", $tanggal_akhir) ?></b></p>
</article>
<table>
	<thead>
		<tr>
			<th>#</th>
			<th>ID</th>
			<th>ISBN</th>
			<th>Judul</th>
			<th>Jumlah Buku</th>
			<th>Kategori</th>
			<th>Lokasi</th>
			<th>Buku Dipinjam</th>
			<th>Buku Hilang</th>
			<th>Dibuat Pada</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count(allBetween("buku", "dibuat_pada", [$tanggal_awal, $tanggal_akhir])) == 0) : ?>
			<tr>
				<td colspan="100%" style="text-align: center">Tidak ada data</td>
			</tr>
		<?php endif ?>
		<?php foreach (allBetween("buku", "dibuat_pada", [$tanggal_awal, $tanggal_akhir]) as $key => $buku) : ?>
			<tr>
				<td><?= $key + 1 ?></td>
				<td><?= codeBuku($buku->id) ?></td>
				<td><?= $buku->isbn ?></td>
				<td><?= $buku->judul ?></td>
				<td><?= $buku->jumlah_buku ?> buah</td>
				<td><?= get("kategori_buku", $buku->kategori_id)->nama_kategori ?></td>
				<td><?= get("lokasi_buku", $buku->lokasi_id)->nama_lokasi ?></td>
				<td><?= sumWhere("detail_peminjaman", "buku_id", $buku->id, "jumlah_buku") ?> buah</td>
				<td><?= sumWhere("buku_hilang", "buku_id", $buku->id, "jumlah_buku") ?> buah</td>
				<td><?= date("d-m-Y", $buku->dibuat_pada) ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<?php
	require_once VIEW_PATH . "layouts/laporan/footer.php";
 ?>
