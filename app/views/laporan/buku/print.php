<?php

use Dompdf\Dompdf;

if($_SERVER["REQUEST_METHOD"] === "POST") {
	if($_POST["print"] == "buku") {
		if (!validation(laporanRules(), $_POST)) {
     		return header("Location: /laporan/buku");
		} 

		$tanggal_awal = date_timestamp_get(date_create($_POST["tanggal_awal"]));
		$tanggal_akhir = date_timestamp_get(date_create($_POST["tanggal_akhir"]));

		$path = "laporan/buku/data.php";
		$file_name = "laporan-buku.pdf";
	}

	if($_POST["print"] == "kategori") {
		$path = "laporan/buku/data_kategori.php";
		$file_name = "laporan-kategori_buku.pdf";
	}

	if($_POST["print"] == "lokasi") {
		$path = "laporan/buku/data_lokasi.php";
		$file_name = "laporan-lokasi_buku.pdf";
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
