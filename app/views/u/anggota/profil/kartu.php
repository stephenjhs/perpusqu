<?php 

$id = auth()->id;

$anggota = get("anggota", $id);

if (is_null($anggota)) {
    return require_once VIEW_PATH . "error/404.php";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>kartu-anggota-<?= $anggota->id ?></title>
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet"> 
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}	

		html {
			font-family: "Source Sans Pro", sans-serif;
			font-size: 12px;
		} 

		body {
			background-color: #151521;
			width: 1366px;
			
		}

		.container {
			padding: 30px;
		}

		.fw-normal {
			font-weight: 400;
		}

		.fw-bold {
			font-weight: 600;
		}

		.col-4 {
			flex: 0 0 auto;
			width: 33%;
		}

		.btn {
			padding: 10px 26px;
			border: 0;
			outline: 0;
			color: #fff;
			cursor: pointer;
			display: inline-block;
		}

		.btn.btn-success {
			background-color: #198754;
		}

		.btn.btn-primary {
			background-color: #435ebe;
		}

		.badge {
			text-align: center;
			display: inline-block;
			color: #fff;
			padding: .175em .475em;
		}

		.badge.bg-success {
			background-color: #198754;
		}

		.card {
			display: flex;
			flex-direction: column;
			max-width: 560px;
		}

		.card-header {
			padding: 18px;
			color: #fff;
			background-color: #990000;
		}

		.card .card-header article {
			max-width: 400px;
		}

		.card .card-header article h1 {
			font-size: 20px;
			margin-top: 2px;
		}

		.card .card-header article h2 {
			font-size: 14px;
		}

		.card .card-header article p {
			margin-top: 8px;
		}

		.card .card-body {
			background-color: #fff;
			display: flex;
			padding: 22px;
		}

		.card .card-body img {
			width: 140px;
			height: 180px;
			object-fit:cover;
		}

		.card .list-group {
			margin-left: 20px;
			width: 100%;
			display: flex;
			flex-direction: column;
		}

		.card .list-group .list-group-item {
			display: flex;
			align-items: center;
			padding: 6px 0;
			border-bottom: 1px dashed black;
		}

		.card .list-group .list-group-item:first-child {
			padding-top: 0;
		}

		.card .list-group .list-group-item:last-child {
			border-bottom: none;
			padding-bottom: 0;
		}

		.buttons {
			display: flex;
			gap: 12px;
			margin-top: 12px;
		}

		@media print {
			 body * {
			    visibility: hidden;
			  }
			  .card * {
			  	visibility: visible;
			  }
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="card">
			<div class="card-header">
				<article>
					<h2 class="fw-normal">Kartu Anggota Perpustakaan</h2>	
					<h1><?= first("informasi")->nama_perpustakaan ?></h1>
					<p><?= first("informasi")->alamat ?></p>
				</article>
			</div>
			<div class="card-body">
				<div>
					<img src="/images/<?= $anggota->gambar ?>">
				</div>
				<div class="list-group">
					<div class="list-group-item">
						<div class="col-4">ID</div>
						<div class="badge bg-success fw-bold"><?= codeAnggota($anggota->id) ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-4">NIS</div>
						<div class="fw-bold"><?= $anggota->nis ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-4">Nama</div>
						<div class="fw-bold"><?= $anggota->nama ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-4">Kelas</div>
						<div class="fw-bold"><?= get("kelas_anggota", $anggota->kelas_id)->nama_kelas ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-4">Gender</div>
						<div class="fw-bold"><?= $anggota->jenis_kelamin ?></div>
					</div>
					<div class="list-group-item">
						<div class="col-4">Bergabung Pada</div>
						<div class="fw-bold"><?= date("d-m-Y", $anggota->dibuat_pada ) ?></div>
					</div>
				</div>
			</div>
		</div>
		<div class="buttons">
			<button class="btn btn-success" id="dl-img" data-id="<?= $anggota->id ?>">Download Gambar</button>
			<button class="btn btn-primary" id="dl-pdf">Download PDF</button>
		</div>
	</div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
	const dlImgEl = document.querySelector("#dl-img")
	const dlPdfEl = document.querySelector("#dl-pdf")

	dlImgEl.addEventListener("click", () => {
		const card = document.querySelector(".card")
		const id = event.target.dataset.id

		html2canvas(card).then(canvas => {
			const base64image = canvas.toDataURL("image/png")
			const anchor = document.createElement("a")
			anchor.setAttribute("href", base64image)
			anchor.setAttribute("download", `kartu-anggota-${id}.png`)
			anchor.click()
			anchor.remove()
		})
	})

	dlPdfEl.addEventListener("click", () => window.print())
</script>

</html>