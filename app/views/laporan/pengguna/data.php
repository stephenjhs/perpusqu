<?php 
	require_once VIEW_PATH . "layouts/laporan/header.php";
?>

<article>
	<h1>Laporan Data Pengguna</h1>
	<p>Dari tanggal <b><?= date("d-m-Y", $tanggal_awal) ?></b> s/d tanggal <b><?= date("d-m-Y", $tanggal_akhir) ?></b></p>
</article>
<table>
	<thead>
		<tr>
			<th>#</th>
			<th>ID</th>
			<th>Username</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Telepon</th>
			<th>Role</th>
			<th>Anggota Dilayani</th>
			<th>Dibuat Pada</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count(allBetween("pengguna", "dibuat_pada", [$tanggal_awal, $tanggal_akhir])) == 0) : ?>
			<tr>
				<td colspan="100%" style="text-align: center">Tidak ada data</td>
			</tr>
		<?php endif ?>
		<?php foreach (allBetween("pengguna", "dibuat_pada", [$tanggal_awal, $tanggal_akhir]) as $key => $pengguna) : ?>
			<tr>
				<td><?= $key + 1 ?></td>
				<td><?= codePengguna($pengguna->id) ?></td>
				<td><?= $pengguna->username ?></td>
				<td><?= $pengguna->nama ?></td>
				<td><?= $pengguna->alamat ?></td>
				<td><?= $pengguna->telepon ?></td>
				<td><?= $pengguna->role ?></td>
				<td><?= amountWhere("peminjaman", "pengguna_id", $pengguna->id) ?> orang</td>
				<td><?= date("d-m-Y", $pengguna->dibuat_pada) ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<?php
	require_once VIEW_PATH . "layouts/laporan/footer.php";
 ?>
