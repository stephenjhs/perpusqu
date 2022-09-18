<?php

use Dompdf\Dompdf;

if($_SERVER["REQUEST_METHOD"] === "POST") {
	if($_POST["print"] == "peminjaman") {
		if (!validation(laporanRules(), $_POST)) {
     		return header("Location: /laporan/transaksi");
		} 

		$tanggal_awal = $_POST["tanggal_awal"];
		$tanggal_akhir = $_POST["tanggal_akhir"];
		$status = $_POST["status"];

		$path = "laporan/transaksi/data.php";
		$file_name = "laporan-peminjaman.pdf";
	}

	if($_POST["print"] == "denda") {
		$path = "laporan/transaksi/data_denda.php";
		$file_name = "laporan-denda.pdf";
	}

	if($_POST["print"] == "bukuhilang") {
		$path = "laporan/transaksi/data_bukuhilang.php";
		$file_name = "laporan-bukuhilang.pdf";
	}

	ob_start();
	require_once VIEW_PATH . $path;
	$content = ob_get_contents();
	ob_end_clean();

	$dompdf = new Dompdf();

	$dompdf->loadHtml($content);

	$dompdf->setPaper("A4", "landscape");

	$dompdf->render();

	$dompdf->stream($file_name);
}

return require_once VIEW_PATH .  "error/404.php";
