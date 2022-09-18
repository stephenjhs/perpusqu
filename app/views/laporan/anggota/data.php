<?php 
	use Illuminate\Database\Capsule\Manager as Capsule;
	require_once VIEW_PATH . "layouts/laporan/header.php";
?>

<article>
	<h1>Laporan Data Anggota</h1>
	<p>Dari tanggal <b><?= date("d-m-Y", $tanggal_awal) ?></b> s/d tanggal <b><?= date("d-m-Y", $tanggal_akhir) ?></b></p>
</article>
<table>
	<thead>
		<tr>
			<th>#</th>
			<th>ID</th>
			<th>NIS</th>
			<th>Username</th>
			<th>Nama</th>
			<th>Telepon</th>
			<th>Kelas</th>
			<th>Buku Dipinjam</th>
			<th>Peminjaman</th>
			<th>Dibuat Pada</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count(allBetween("anggota", "dibuat_pada", [$tanggal_awal, $tanggal_akhir])) == 0) : ?>
			<tr>
				<td colspan="100%" style="text-align: center">Tidak ada data</td>
			</tr>
		<?php endif ?>
		<?php foreach (allBetween("anggota", "dibuat_pada", [$tanggal_awal, $tanggal_akhir]) as $key => $anggota) : ?>
			<tr>
				<td><?= $key + 1 ?></td>
				<td><?= codeAnggota($anggota->id) ?></td>
				<td><?= $anggota->nis ?></td>
				<td><?= $anggota->username ?></td>
				<td><?= $anggota->nama ?></td>
				<td><?= $anggota->telepon ?></td>
				<td><?= get("kelas_anggota", $anggota->kelas_id)->nama_kelas ?></td>
				<td><?= Capsule::table("detail_peminjaman")->whereIn("peminjaman_id", pluck("peminjaman", "anggota_id", $anggota->id, "id"))->sum("jumlah_buku") ?> buah</td>
				<td><?= amountWhere("peminjaman", "anggota_id", $anggota->id) ?> kali</td>
				<td><?= date("d-m-Y", $anggota->dibuat_pada) ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<?php
	require_once VIEW_PATH . "layouts/laporan/footer.php";
 ?>
