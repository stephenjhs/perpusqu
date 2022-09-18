<?php

use Dompdf\Dompdf;

if($_SERVER["REQUEST_METHOD"] === "POST") {
	if($_POST["print"] == "kas") {
		if (!validation(laporanRules(), $_POST)) {
     		return header("Location: /laporan/kas");
		} 

		$tanggal_awal = $_POST["tanggal_awal"];
		$tanggal_akhir = $_POST["tanggal_akhir"];
		$tipe_kas = $_POST["tipe_kas"];

		$path = "laporan/kas/data.php";
		$file_name = "laporan-kas.pdf";
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
