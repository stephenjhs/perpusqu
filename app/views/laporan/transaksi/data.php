<?php 
	use Illuminate\Database\Capsule\Manager as Capsule;
	require_once VIEW_PATH . "layouts/laporan/header.php";

	$data = Capsule::table("peminjaman")->whereBetween("tanggal_peminjaman", [$tanggal_awal, $tanggal_akhir]);
	if($status != "") {
		$data = $data->where("status", $status)->orderBy("id", "DESC")->get();
	} else {
		$data = $data->orderBy("id", "DESC")->get();
	}
?>

<article>
	<h1>Laporan Data Transaksi</h1>
	<p>Dari tanggal <b><?= $tanggal_awal ?></b> s/d tanggal <b><?= $tanggal_akhir ?></b></p>
</article>
<table>
	<thead>
		<tr>
			<th>#</th>
			<th>ID</th>
			<th>Peminjam</th>
			<th>Jumlah Buku</th>
			<th>Tanggal</th>
			<th>Batas</th>
			<th>Denda</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count($data) == 0) : ?>
			<tr>
				<td colspan="100%" style="text-align: center">Tidak ada data</td>
			</tr>
		<?php endif ?>
		<?php foreach ($data as $key => $peminjaman) : ?>
			<tr>
				<td><?= $key + 1 ?></td>
                <td><?= codePeminjaman($peminjaman->id) ?></td>
                <td><?= get("anggota", $peminjaman->anggota_id)->nama ?></td>
                <td><?= sumWhere("detail_peminjaman", "peminjaman_id", $peminjaman->id, "jumlah_buku") ?> buah</td>
                <td><?= $peminjaman->tanggal_peminjaman ?></td>
                <td><?= $peminjaman->batas_pengembalian ?></td>
                <td><?= denda($peminjaman->id) ?></td>
                <td>
                    <?php if(statusPeminjamanBayarDenda($peminjaman->id)) : ?>
                        Belum bayar denda
                    <?php elseif($peminjaman->status == 0) : ?>
                        Belum dikembalikan
                    <?php else : ?>
                        Sudah kembali
                    <?php endif ?>
                </td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<?php
	require_once VIEW_PATH . "layouts/laporan/footer.php";
 ?>
