<h1>Perpusqu - Sistem Informasi Perpustakaan</h1>

![sppie-preview](https://github.com/stephenjhs/perpusqu/blob/master/screenshot.png)

<h4>Website pengelolaan perpustakaan yang dibuat dengan PHP 8.
</h4>

<p>
  <a href="#tentang">About Perpusqu</a> •
  <a href="#fitur">Fitur</a> •
  <a href="#download">Download & Install</a> •
</p>

<h2 id="tentang">About Perpusqu</h2>

Website yang digunakan untuk mengelola data buku.

<h2 id="fitur">✨ Fitur Tersedia</h2>

- BANYAK LAH POKOKNYA, MALAS TERANGINNYA SATU-SATU

<h2 id="demo">Halaman Demo</h2>

Udah kuhostingnya di heroku semalam, cuman driver databasenya gak bisa pake mysql, mau gak mau pake heroku postgresql. jadi yaudahlah kalo mau coba websitenya langsung aja cus clone reponya yaahh :*

<h2 id="syarat">Pra-Instalasi</h2>

Agak ko perhatikan dlu apa apa aja yang harus ada di laptopmu ya

- PHP 8 & Web Server [XAMPP, LAMPP, MAMP] (BTW AKU GAK PAKE SALAH SATU DARI 3 WEBSERVER ITU, THE REAL WEBDEV SETUP MANUAL ANJAY)
- Composer
- NodeJS
- Web Browser [Chrome, Firefox, Safari & Opera]
- Internet

<h2 id="download">Cara Install</h2>

```bash
# Clone repository ini atau download di
$ git clone https://github.com/stephenjhs/perpusqu.git

# Kemudian jalankan command composer install, ini akan menginstall resources yang dibutuhkan
$ composer install

# Jalankan web server (AGAK BEDA SAMA SERVER DI XAMPP, INI HARUS DARI SINI DIA DI RUN SERVERNYA, KALO GAK ERROR DIA)
$ php -S localhost:8000 -t public

# habis tu ko buka dlu browser kau baru ketikan 'localhost/phpmyadmin'
# import lah database nya, ada di folder app/config/perpusqu.sql
# kalo mau ubah data initialize nya bisa edit aja di phpmyadminnya
# udah selesai, kalo mau tes login boleh, ada pada 'localhost:8000/login' <- itu route nya

# Selamat website dapat anda nikmati di local!
```

**<p>Sekian dari saya thenkyou</p>**