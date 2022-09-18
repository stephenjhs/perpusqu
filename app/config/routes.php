<?php

Route::url("/", "home/index");

Route::url("/login", "login");
Route::url("/registrasi", "registrasi");
Route::url("/logout", "logout");

Route::url("/api/buku", "api/buku");
Route::url("/api/update_buku_peminat", "api/update_buku_peminat");
Route::url("/api/online_status", "api/online_status");
Route::url("/api/peminjaman_bulanan", "api/peminjaman_bulanan");
Route::url("/api/peminjaman_bulanan_anggota", "api/peminjaman_bulanan_anggota");

if($_SESSION["type"] == "pengguna") {
	Route::url("/dashboard", "dashboard");

	Route::url("/anggota", "anggota/index");
	if(isAdmin()) {
		Route::url("/anggota/create", "anggota/create");
		Route::url("/anggota/store", "anggota/store");
		Route::url("/anggota/edit", "anggota/edit");
		Route::url("/anggota/update", "anggota/update");
		Route::url("/anggota/delete", "anggota/delete");
		Route::url("/anggota/ubahpassword/edit", "anggota/ubahpassword/edit");
		Route::url("/anggota/ubahpassword/update", "anggota/ubahpassword/update");
	}
	Route::url("/anggota/kartu", "anggota/kartu");

	Route::url("/anggota/kelas", "anggota/kelas/index");
	Route::url("/anggota/kelas/store", "anggota/kelas/store");
	Route::url("/anggota/kelas/edit", "anggota/kelas/edit");
	Route::url("/anggota/kelas/update", "anggota/kelas/update");
	Route::url("/anggota/kelas/delete", "anggota/kelas/delete");

	Route::url("/buku", "buku/index");
	if(isAdmin()) {
		Route::url("/buku/create", "buku/create");
		Route::url("/buku/store", "buku/store"); 
		Route::url("/buku/edit", "buku/edit");  
		Route::url("/buku/update", "buku/update");   
		Route::url("/buku/delete", "buku/delete");  
	} 

	Route::url("/buku/kategori", "buku/kategori/index");  
	Route::url("/buku/kategori/store", "buku/kategori/store");  
	Route::url("/buku/kategori/edit", "buku/kategori/edit"); 
	Route::url("/buku/kategori/update", "buku/kategori/update");  
	Route::url("/buku/kategori/delete", "buku/kategori/delete"); 
	Route::url("/buku/lokasi", "buku/lokasi/index"); 
	Route::url("/buku/lokasi/store", "buku/lokasi/store");  
	Route::url("/buku/lokasi/edit", "buku/lokasi/edit");  
	Route::url("/buku/lokasi/update", "buku/lokasi/update");  
	Route::url("/buku/lokasi/delete", "buku/lokasi/delete"); 

	Route::url("/transaksi", "transaksi/index"); 
	Route::url("/transaksi/peminjaman", "transaksi/peminjaman/create");  
	Route::url("/transaksi/peminjaman/store", "transaksi/peminjaman/store"); 
	Route::url("/transaksi/pengembalian", "transaksi/pengembalian/index"); 
	Route::url("/transaksi/pengembalian/delete", "transaksi/pengembalian/delete");  
	Route::url("/transaksi/pengembalian/perpanjangan", "transaksi/pengembalian/perpanjangan"); 
	Route::url("/transaksi/pengembalian/kembalikan", "transaksi/pengembalian/kembalikan"); 
	Route::url("/transaksi/pengembalian/kembalikansemua", "transaksi/pengembalian/kembalikansemua"); 
	Route::url("/transaksi/pengembalian/bayardenda", "transaksi/pengembalian/bayardenda"); 
	Route::url("/transaksi/denda", "transaksi/denda/index"); 
	Route::url("/transaksi/denda/update", "transaksi/denda/update"); 
	Route::url("/transaksi/bukuhilang", "transaksi/bukuhilang/index"); 
	Route::url("/transaksi/bukuhilang/create", "transaksi/bukuhilang/create"); 
	Route::url("/transaksi/bukuhilang/store", "transaksi/bukuhilang/store"); 
	Route::url("/transaksi/bukuhilang/bayarkerugian", "transaksi/bukuhilang/bayarkerugian"); 
	Route::url("/transaksi/bukuhilang/delete", "transaksi/bukuhilang/delete"); 

	Route::url("/kas", "kas/index"); 
	Route::url("/kas/create", "kas/create"); 
	Route::url("/kas/store", "kas/store"); 

	Route::url("/laporan", "laporan/index"); 
	Route::url("/laporan/anggota", "laporan/anggota/index"); 
	Route::url("/laporan/anggota/print", "laporan/anggota/print"); 
	Route::url("/laporan/buku", "laporan/buku/index"); 
	Route::url("/laporan/buku/print", "laporan/buku/print"); 
	Route::url("/laporan/transaksi", "laporan/transaksi/index"); 
	Route::url("/laporan/transaksi/print", "laporan/transaksi/print");
	Route::url("/laporan/kas", "laporan/kas/index"); 
	Route::url("/laporan/kas/print", "laporan/kas/print"); 
	Route::url("/laporan/pengguna", "laporan/pengguna/index"); 
	Route::url("/laporan/pengguna/print", "laporan/pengguna/print"); 

	Route::url("/profil", "profil/index"); 
	Route::url("/profil/catatan", "profil/catatan/index"); 
	Route::url("/profil/catatan/store", "profil/catatan/store"); 
	Route::url("/profil/catatan/delete", "profil/catatan/delete");

	Route::url("/pengguna", "pengguna/index"); 
	if(isAdmin()) {
		Route::url("/pengguna/create", "pengguna/create");
		Route::url("/pengguna/store", "pengguna/store");
		Route::url("/pengguna/delete", "pengguna/delete");
	}
	Route::url("/pengguna/edit", "pengguna/edit");
	Route::url("/pengguna/update", "pengguna/update");
	Route::url("/pengguna/ubahpassword/edit", "pengguna/ubahpassword/edit");
	Route::url("/pengguna/ubahpassword/update", "pengguna/ubahpassword/update"); 

	Route::url("/informasi", "informasi/index"); 
	if(isAdmin()) {
		Route::url("/informasi/edit", "informasi/edit"); 
		Route::url("/informasi/update", "informasi/update"); 
	}

	Route::url("/pengaturan", "pengaturan/index"); 
	if(isAdmin()) {
		Route::url("/pengaturan/hapusgambar", "pengaturan/hapusgambar"); 
	}
	Route::url("/pengaturan/notifikasi", "pengaturan/notifikasi"); 
}
else if($_SESSION["type"] == "anggota") {
	Route::url("/u/anggota/dashboard", "u/anggota/dashboard"); 

	Route::url("/u/anggota/buku", "u/anggota/buku"); 

	Route::url("/u/anggota/transaksi", "u/anggota/transaksi/index"); 
	Route::url("/u/anggota/transaksi/peminjaman", "u/anggota/transaksi/peminjaman/create"); 
	Route::url("/u/anggota/transaksi/peminjaman/store", "u/anggota/transaksi/peminjaman/store"); 
	Route::url("/u/anggota/transaksi/denda", "u/anggota/transaksi/denda"); 

	Route::url("/u/anggota/profil", "u/anggota/profil/index"); 
	Route::url("/u/anggota/profil/edit", "u/anggota/profil/edit"); 
	Route::url("/u/anggota/profil/update", "u/anggota/profil/update"); 
	Route::url("/u/anggota/profil/ubahpassword", "u/anggota/profil/ubahpassword/edit");
	Route::url("/u/anggota/profil/ubahpassword/update", "u/anggota/profil/ubahpassword/update");
	Route::url("/u/anggota/profil/kartu", "u/anggota/profil/kartu"); 

	Route::url("/u/anggota/pengaturan", "u/anggota/pengaturan"); 
}
