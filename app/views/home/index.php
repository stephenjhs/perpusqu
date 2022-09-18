<?php 
$informasi = first("informasi");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?= APP_NAME ?></title>

		<link rel="stylesheet" href="/css/tailwind.css" />
		<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet" />
	</head>
	<body class="antialiased bg-[#f2f7ff]">
		<nav class="pt-8 pb-20">
			<div class="container max-w-7xl mx-auto px-6 xl:px-4 flex items-center justify-between">
				<a href="/" class="uppercase font-bold"><?= APP_NAME ?></a>
				<ul>
					<?php if($_SESSION["is_login"] == 1) : ?>
					<li>
						<a href="/login">Dashboard</a>
					</li>
					<?php else : ?>
					<li>
						<a href="/registrasi" class="py-2 px-8 rounded hidden md:inline-block">Registrasi</a>
						<a href="/login" class="py-2 px-8 text-white bg-black inline-block font-semibold rounded">Login</a>
					</li>
					<?php endif ?>
				</ul>
			</div>
		</nav>
		<section class="py-20 pb-32">
			<div class="container max-w-7xl mx-auto px-6 xl:px-4 flex md:items-center md:justify-center md:text-center flex-col">
				<article class="">
					<p class="font-semibold text-orange-600 mb-2 uppercase">Welcome to</p>
					<h1 class="text-3xl md:text-4xl font-extrabold mb-3"><?= $informasi->nama_perpustakaan ?></h1>
					<p class="leading-[32px] mb-6"><?= $informasi->tentang ?></p>
					<a href="#daftar-buku" class="py-2 text-white px-8 bg-orange-800 font-semibold inline-block rounded"
						>Lihat Daftar Buku</a
					>
				</article>
				<img src="/images/home/sc.png" class="mt-10 rounded-md" alt="" />
			</div>
		</section>
		<section class="py-20">
			<div class="container max-w-7xl mx-auto px-6 xl:px-4 flex flex-col">
				<article class="mb-6">
					<h2 class="text-2xl md:text-3xl font-extrabold mb-2">Tentang Perpustakaan</h2>
					<p class="leading-[32px]">
						Berikut adalah informasi lengkap tentang
						<?= $informasi->nama_perpustakaan ?>
					</p>
				</article>
				<aside class="flex flex-col md:flex-row gap-6">
					<div class="flex-none h-[200px] md:h-[500px] relative w-full md:w-5/12">
						<img src="/images/home/about.jpg" class="absolute inset-0 w-full h-full object-cover" loading="lazy" />
					</div>
					<div class="w-full">
						<div class="grid gap-6 grid-cols">
							<div class="border border-dashed border-slate-800 bg-white p-4 flex flex-col">
								<small class="text-sm mb-1">Nama Perpustakaan</small>
								<h3 class="font-semibold text-black text-lg"><?= $informasi->nama_perpustakaan ?></h3>
							</div>
							<div class="border border-dashed border-slate-800 bg-white p-4 flex flex-col">
								<small class="text-sm mb-1">Alamat</small>
								<h3 class="font-semibold text-black text-lg"><?= $informasi->alamat ?></h3>
							</div>
							<div class="border border-dashed border-slate-800 bg-white p-4 flex flex-col">
								<small class="text-sm mb-1">Website</small>
								<a href="<?= $informasi->website ?>" class="font-semibold underline text-orange-800 text-lg" target="_blank"><?= $informasi->website ?></a>
							</div>
							<div class="border border-dashed border-slate-800 bg-white p-4 flex flex-col">
								<small class="text-sm mb-1">Email</small>
								<h3 class="font-semibold text-black text-lg"><?= $informasi->email ?></h3>
							</div>
							<div class="border border-dashed border-slate-800 bg-white p-4 flex flex-col">
								<small class="text-sm mb-1">Dibuat Pada</small>
								<h3 class="font-semibold text-black text-lg"><?= timeago("@" . $informasi->dibuat_pada) ?></h3>
							</div>
							<div class="border border-dashed border-slate-800 bg-white p-4 flex flex-col">
								<small class="text-sm mb-1">Jumlah Anggota</small>
								<h3 class="font-semibold text-black text-lg">
									<?= amount("anggota") ?>
									orang
								</h3>
							</div>
							<div class="border border-dashed border-slate-800 bg-white p-4 flex flex-col">
								<small class="text-sm mb-1">Jumlah Buku</small>
								<h3 class="font-semibold text-black text-lg">
									<?= sum("buku", "jumlah_buku") ?>
									buah
								</h3>
							</div>
							<div class="border border-dashed border-slate-800 bg-white p-4 flex flex-col">
								<small class="text-sm mb-1">Jumlah Pengguna</small>
								<h3 class="font-semibold text-black text-lg">
									<?= amount("pengguna") ?>
									orang
								</h3>
							</div>
							<div class="text-black bg-yellow-400 p-4 flex flex-col">
								<small class="text-sm mb-1">Besaran Denda</small>
								<h3 class="font-semibold text-black text-lg">
									<?= rp(first("denda")->besaran_denda) ?> / hari
								</h3>
							</div>
							<div class="text-white bg-green-800 p-4 flex flex-col">
								<small class="text-sm mb-1">User Sedang Online</small>
								<h3 class="font-semibold text-lg">
									<?= amount("online") ?>
									orang
								</h3>
							</div>
						</div>
					</div>
				</aside>
			</div>
		</section>
		<section class="py-20 pb-72" id="daftar-buku">
			<div class="container max-w-7xl mx-auto px-6 xl:px-6">
				<article class="flex flex-col mb-10">
					<h2 class="text-2xl md:text-3xl font-extrabold mb-2">Daftar Buku</h2>
					<p class="leading-relaxed w-full md:w-8/12 mb-5">
						Berikut adalah daftar buku yang akan kami pinjamkan kepada anda.
					</p>
					<div class="group relative">
						<svg
							xmlns="http://www.w3.org/2000/svg"
							width="20"
							height="20"
							viewBox="0 0 24 24"
							fill="none"
							stroke="currentColor"
							stroke-width="2"
							stroke-linecap="round"
							stroke-linejoin="round"
							class="absolute left-4 top-1/2 -mt-2.5 text-slate-400 pointer-events-none group-focus-within:text-blue-500"
						>
							<circle cx="11" cy="11" r="8"></circle>
							<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
						</svg>
						<input
							class="focus:ring-2 focus:ring-blue-500 focus:outline-none appearance-none w-full text-sm leading-6 text-slate-900 placeholder-slate-400 py-2 pl-12 ring-1 ring-slate-800 shadow-sm"
							id="cari-buku"
							placeholder="Cari buku..."
						/>
					</div>
				</article>
				<div class="grid grid-cols lg:grid-cols-2 gap-6" id="book-content">
					<?php if(amount("buku") == 0) : ?>
					<p style="grid-column: 1/4" class="text-center p-3 rounded bg-red-200">Tidak ada daftar buku.</p>
					<?php endif ?>
					<?php foreach(allLimit("buku", 12) as $buku) : ?>
					<div class="flex flex-col sm:flex-row p-3 border border-dashed border-slate-800">
						<div class="flex-none w-full sm:w-[210px] h-[210px] sm:h-[280px] relative">
							<img
								src="/images/<?= $buku->sampul ?>"
								alt=""
								class="absolute inset-0 w-full h-full object-cover"
								loading="lazy"
							/>
						</div>
						<form class="flex-auto p-3 pt-5 lg:pt-3 sm:p-6">
							<div class="flex flex-wrap mb-6">
								<h3 class="flex-auto text-lg font-semibold text-black"><?= $buku->judul ?></h3>
								<div class="w-full flex-none text-sm font-medium text-slate-800 mt-2">
									Pengarang :
									<?= $buku->pengarang ?>
								</div>
								<div class="w-full flex-none text-sm font-medium text-slate-800 mt-2">
									Harga : <b><?= rp($buku->harga) ?></b>
								</div>
								<div class="w-full flex-none text-sm font-medium text-slate-800 mt-2">
									Peminat :
									<?= $buku->peminat ?> orang
								</div>
							</div>
							<div class="flex space-x-4 mb-6 text-sm font-medium">
								<div class="flex-auto flex space-x-4">
									<a
										class="h-10 flex items-center px-8 rounded font-semibold bg-black text-white detail-buku"
										role="button"
										data-id="<?= $buku->id ?>"
										data-code="<?= codeBuku($buku->id) ?>"
										data-isbn="<?= $buku->isbn ?>"
										data-judul="<?= $buku->judul ?>"
										data-pengarang="<?= $buku->pengarang ?>"
										data-penerbit="<?= $buku->penerbit ?>"
										data-tahun_terbit="<?= $buku->tahun_terbit ?>"
										data-jumlah_buku="<?= $buku->jumlah_buku ?> buah"
										data-kategori_id="<?= get('kategori_buku', $buku->kategori_id)->nama_kategori ?>"
										data-lokasi_id="<?= get('lokasi_buku', $buku->lokasi_id)->nama_lokasi ?>"
										data-total_halaman="<?= $buku->total_halaman ?> halaman"
										data-harga="<?= rp($buku->harga) ?>"
										data-keterangan="<?= $buku->keterangan ?>"
										data-peminat="<?= $buku->peminat ?>"
										data-dibuat_pada="<?= timeago('@' . $buku->dibuat_pada) ?>"
										data-dipinjam="<?= sumWhere('detail_peminjaman', 'buku_id', $buku->id, 'jumlah_buku') ?> kali"
									>
										Detail Buku
									</a>
								</div>
							</div>
							<p class="text-sm text-slate-800">
								Total
								<?= $buku->total_halaman ?> halaman
							</p>
						</form>
					</div>
					<?php endforeach ?>
				</div>
			</div>
		</section>
		<footer class="py-10">
			<div class="container max-w-7xl mx-auto px-6 xl:px-6 flex flex-col sm:flex-row justify-between items-center gap-2 sm:gap-0">
		        <div class="">
		            <p><?= date("Y") ?> &copy; <?= APP_NAME ?></p>
		        </div>
		        <div class="">
		            <p><?= first("informasi")->nama_perpustakaan ?></p>
		        </div>
			</div>
		</footer>
		<div class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="modal">
			<div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

			<div class="fixed z-10 inset-0 overflow-y-auto">
				<div class="flex items-center justify-center min-h-full p-4 sm:p-0 overlay">
					<div
						class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 max-w-2xl w-full"
					>
						<div class="bg-white px-5 pt-5 pb-4 sm:p-6 sm:pb-4 mb-3">
							<div class="sm:flex sm:items-start">
								
								<div class="w-full" id="modal-content">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>

	<script>
		const modalEl = document.querySelector("#modal")
		const modalContentEl = document.querySelector("#modal-content")
		const cariBukuEl = document.querySelector("#cari-buku")
		const bookContentEl = document.querySelector("#book-content")

		function formatRupiah(val) {
			return val.toLocaleString("id-ID", {})
		}

		function displayContent(data, value) {
			let books = ""
			if (data.length == 0) {
				bookContentEl.innerHTML = emptyElement(value)
			} else {
				data.forEach(item => (books += element(item)))
				bookContentEl.innerHTML = books
			}
		}

		function emptyElement(value) {
			return `
				<p style="grid-column: 1/4" class="text-center p-3 rounded bg-slate-200">Maaf kata kunci ${value} tidak ditemukan.</p>
			`
		}

		function element(item) {
			return `
			<div class="flex flex-col sm:flex-row p-3 border border-dashed border-slate-800">
					<div class="flex-none w-full sm:w-[210px] h-[210px] sm:h-[280px] relative">
						<img
							src="/images/${item.sampul}"
							alt=""
							class="absolute inset-0 w-full h-full object-cover"
							loading="lazy"
						/>
					</div>
					<form class="flex-auto p-3 pt-5 lg:pt-3 sm:p-6">
						<div class="flex flex-wrap mb-6">
							<h3 class="flex-auto text-lg font-semibold text-black">${item.judul}</h3>
							<div class="w-full flex-none text-sm font-medium text-slate-800 mt-2">
								Pengarang :
								${item.pengarang}
							</div>
							<div class="w-full flex-none text-sm font-medium text-slate-800 mt-2">
								Harga : <b>${item.harga}</b>
							</div>
							<div class="w-full flex-none text-sm font-medium text-slate-800 mt-2">
								Peminat :
								${item.peminat} orang
							</div>
						</div>
						<div class="flex space-x-4 mb-6 text-sm font-medium">
							<div class="flex-auto flex space-x-4">
								<a
									class="h-10 flex items-center px-8 rounded font-semibold bg-black text-white detail-buku"
									role="button"
									data-id="${item.id}"
									data-code="${item.code}"
									data-isbn="${item.isbn}"
									data-judul="${item.judul}"
									data-pengarang="${item.pengarang}"
									data-penerbit="${item.penerbit}"
									data-tahun_terbit="${item.tahun_terbit}"
									data-jumlah_buku="${item.jumlah_buku} buah"
									data-kategori_id="${item.kategori_id}"
									data-lokasi_id="${item.lokasi_id}"
									data-total_halaman="${item.total_halaman} halaman"
									data-harga="${item.harga}"
									data-keterangan="${item.keterangan}"
									data-peminat="${item.peminat}"
									data-dibuat_pada="${item.dibuat_pada}"
									data-dipinjam="${item.dipinjam} kali"
								>
									Detail Buku
								</a>
							</div>
						</div>
						<p class="text-sm text-slate-800">
							Total
							${item.total_halaman} halaman
						</p>
					</form>
				</div>
			`
		}

		 async function updateBukuPeminat(id) {
	      const response = await fetch(`${window.location.origin}/api/update_buku_peminat`, {
	        headers: {
		      'Accept': 'application/json',
		      'Content-Type': 'application/json'
		    },
		    method: "POST",
		    body: JSON.stringify({id: id})
	      });
	    }

		async function getBuku() {
			const value = event.target.value
			const response = await fetch(`${window.location.origin}/api/buku?judul=${value}`)
			const data = await response.json()

			displayContent(data, value)
		}

		window.addEventListener("click", () => {
			if (event.target.classList.contains("detail-buku")) {
				modalEl.classList.toggle("hidden")
				const id = event.target.dataset.id
				const code = event.target.dataset.code
				const isbn = event.target.dataset.isbn
				const judul = event.target.dataset.judul
				const pengarang = event.target.dataset.pengarang
				const penerbit = event.target.dataset.penerbit
				const tahun_terbit = event.target.dataset.tahun_terbit
				const jumlah_buku = event.target.dataset.jumlah_buku
				const kategori_id = event.target.dataset.kategori_id
				const lokasi_id = event.target.dataset.lokasi_id
				const total_halaman = event.target.dataset.total_halaman
				const harga = event.target.dataset.harga
				const keterangan = event.target.dataset.keterangan
				const peminat = event.target.dataset.peminat
				const dibuat_pada = event.target.dataset.dibuat_pada
				const dipinjam = event.target.dataset.dipinjam

				updateBukuPeminat(id)

				modalContentEl.innerHTML = `
				<div class="flex justify-between items-center mb-4"> 
					<h3 class="text-lg leading-6 font-semibold text-gray-900">${judul}</h3>
					<a href="/u/anggota/transaksi/peminjaman" class="bg-blue-800 px-6 py-2 text-white rounded inline-block text-sm">Pinjam Buku</a>
				</div>
					<div class="mt-2">
						<div class="text-sm text-gray-500 flex flex-col gap-2">
							<div>
								ID : ${code}
							</div>
							<div>
								ISBN : ${isbn}
							</div>
							<div>
								Pengarang : ${pengarang}
							</div>
							<div>
								Penerbit : ${penerbit}
							</div>
							<div>
								Tahun Terbit : ${tahun_terbit}
							</div>
							<hr class="my-1 border border-dashed border-gray-400">
							<div>
								Jumlah Buku : ${jumlah_buku}
							</div>
							<div>
								Kategori : ${kategori_id}
							</div>
							<div>
								Lokasi : ${lokasi_id}
							</div>
							<div>
								Total Halaman : ${total_halaman}
							</div>
							<div>
								Harga : <b>${harga}</b>	
							</div>
							<hr class="my-1 border border-dashed border-gray-400">
							<div>
								Keterangan : ${keterangan}
							</div>
							<div>
								Peminat : ${peminat} orang
							</div>
							<div>
								Dibuat Pada : ${dibuat_pada}
							</div>
							<div>
								Buku Dipinjam : ${dipinjam}
							</div>
						</div>
					</div>
				`
			}
			if (event.target.classList.contains("overlay")) {
				modalEl.classList.toggle("hidden")
			}
		})
		cariBukuEl.addEventListener("input", () => getBuku())
	</script>
</html>
