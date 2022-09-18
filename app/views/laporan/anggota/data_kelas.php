<?php 
	require_once VIEW_PATH . "layouts/laporan/header.php";
?>

<article>
	<h1>Laporan Data Kelas</h1>
</article>
<table>
	<thead>
		<tr>
			<th>#</th>
			<th>ID</th>
			<th>Nama Kelas</th>
			<th>Jumlah Anggota</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count(all("kelas_anggota")) == 0) : ?>
			<tr>
				<td colspan="100%" style="text-align: center">Tidak ada data</td>
			</tr>
		<?php endif ?>
		<?php foreach (all("kelas_anggota") as $key => $kelas) : ?>
			<tr>
				<td><?= $key + 1 ?></td>
				<td><?= codeKelas($kelas->id) ?></td>
				<td><?= $kelas->nama_kelas ?></td>
				<td><?= amountWhere("anggota", "kelas_id", $kelas->id) ?> orang</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<?php
	require_once VIEW_PATH . "layouts/laporan/footer.php";
 ?>
