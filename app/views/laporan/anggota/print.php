<?php

use Dompdf\Dompdf;

if($_SERVER["REQUEST_METHOD"] === "POST") {
	if($_POST["print"] == "anggota") {
		if (!validation(laporanRules(), $_POST)) {
     		return header("Location: /laporan/anggota");
		} 

		$tanggal_awal = date_timestamp_get(date_create($_POST["tanggal_awal"]));
		$tanggal_akhir = date_timestamp_get(date_create($_POST["tanggal_akhir"]));

		$path = "laporan/anggota/data.php";
		$file_name = "laporan-anggota.pdf";
	}

	if($_POST["print"] == "kelas") {
		$path = "laporan/anggota/data_kelas.php";
		$file_name = "laporan-kelas_anggota.pdf";
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
