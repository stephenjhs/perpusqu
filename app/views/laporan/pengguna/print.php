<?php

use Dompdf\Dompdf;

if($_SERVER["REQUEST_METHOD"] === "POST") {
	if($_POST["print"] == "pengguna") {
		if (!validation(laporanRules(), $_POST)) {
     		return header("Location: /laporan/pengguna");
		} 

		$tanggal_awal = date_timestamp_get(date_create($_POST["tanggal_awal"]));
		$tanggal_akhir = date_timestamp_get(date_create($_POST["tanggal_akhir"]));

		$path = "laporan/pengguna/data.php";
		$file_name = "laporan-pengguna.pdf";
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
