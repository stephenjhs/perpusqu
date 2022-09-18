<?php

function loginRules()
{
    return [
        "username" => "required",
        "password" => "required",
    ];
}

function registrasiRules()
{
    return [
        "nis" => "required|max:10",
        "username" => "required",
        "nama" => "required",
        "password" => "required|confirmed",
        "password_confirmation" => "required",
        "jenis_kelamin" => "required",
        "kelas_id" => "required",
    ];
}

function anggotaRules()
{
    return [
        "nis" => "required|max:10",
        "username" => "required|max:32",
        "nama" => "required",
        "password" => "required|confirmed",
        "password_confirmation" => "required",
        "alamat" => "required",
        "telepon" => "required",
        "tanggal_lahir" => "required",
        "jenis_kelamin" => "required",
        "kelas_id" => "required",
    ];
}

function editAnggotaRules()
{
    return [
        "nis" => "required|max:10",
        "username" => "required|max:32",
        "nama" => "required",
        "alamat" => "required",
        "telepon" => "required",
        "tanggal_lahir" => "required",
        "jenis_kelamin" => "required",
        "kelas_id" => "required",
    ];
}

function kelasRules()
{
    return [
        "nama_kelas" => "required"
    ];
}

function bukuRules()
{
    return [
        "isbn" => "required",
        "judul" => "required",
        "pengarang" => "required",
        "penerbit" => "required",
        "tahun_terbit" => "required",
        "jumlah_buku" => "required|gt:0",
        "kategori_id" => "required",
        "lokasi_id" => "required",
        "total_halaman" => "required",
        "harga" => "required|gte:0",
    ];
}

function kategoriRules()
{
    return [
        "nama_kategori" => "required"
    ];
}

function lokasiRules()
{
    return [
        "nama_lokasi" => "required"
    ];
}

function peminjamanRules() 
{
    return [
        "anggota_id" => "required",
        "batas_pengembalian" => "required",
        "denda" => "required|gte:0",
    ];
}

function bukuHilangRules()
{
    return [
        "buku_id" => "required",
        "jumlah_buku" => "required|gt:0",
        "harga" => "required",
        "status" => "required",
    ];
}

function kasRules()
{
    return [
        "besaran_kas" => "required",
        "keterangan" => "required",
        "tipe_kas" => "required",
    ];
}

function laporanRules()
{
    return [
        "tanggal_awal" => "required",
        "tanggal_akhir" => "required",
    ];
}

function penggunaRules()
{
    return [
        "username" => "required|max:32",
        "nama" => "required",
        "password" => "required|confirmed",
        "password_confirmation" => "required",
        "alamat" => "required",
        "jenis_kelamin" => "required",
        "telepon" => "required",
        "role" => isAdmin() ? "required" : "nullable",
    ];
}

function editPenggunaRules()
{
    return [
        "username" => "required|max:32",
        "nama" => "required",
        "alamat" => "required",
        "jenis_kelamin" => "required",
        "telepon" => "required",
        "role" => isAdmin() ? "required" : "nullable",
    ];
}

function ubahpasswordRules() {
    return [
        "password" => "required|confirmed",
        "password_confirmation" => "required",
    ];
}

function informasiRules()
{
    return [
        "nama_perpustakaan" => "required|max:52",
        "website" => "required|url",
        "email" => "required|email",
        "tentang" => "required",
        "alamat" => "required",
    ];
}

function validation($rules, $data)
{
    $validator = (new Validator())->make($data = $data, $rules = $rules);

    $oldValues = [];
    $messages = [];

    foreach ($data as $key => $value) {
        if(gettype($value) != "array") {
            $oldValues[$key] = trim($value);
        }
    }
    
    setOldSession($oldValues);

    if ($validator->fails()) {
        foreach ($validator->errors()->messages() as $key => $value) {
            $messages[$key] = $value[0];
        }

        setValidationSession($messages);
        return false;
    }

    return true;
}
