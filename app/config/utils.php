<?php 

use Illuminate\Database\Capsule\Manager as Capsule;

function auth() {
    return get($_SESSION["type"], $_SESSION["id"]);
}

function isAdmin() {
    return auth()->role == "admin" ? true : false;
}

function isPetugas() {
    return auth()->role == "petugas" ? true : false;
}

function generateColumns($data)
{
    $columns = [];
    foreach ($data as $key => $value) {
        $columns[$key] = htmlspecialchars($value);
    }
    return $columns;
}

function generateCode($char, $table, $id) {
    $code = $char . sprintf("%04s", $id);
    if($id == null) {
        $latest_id = latter($table);
        $code = $char . sprintf("%04s", $latest_id + 1);
    }
    return $code;
}

function day_diff($first_date, $second_date) {
    return date_diff(date_create($first_date), date_create($second_date))->days;
}

function timeago($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = [
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    ];
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v;
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' yang lalu' : 'Baru saja';
}

function rp($value) {
    return "Rp " . number_format($value, 0, ",", ".");
}

function denda($id) {
    $peminjaman = get("peminjaman", $id);

    $selisih_hari_ini = day_diff(date("Y-m-d"), $peminjaman->batas_pengembalian);
    $selisih_tanggal_dikembalikan = day_diff($peminjaman->tanggal_dikembalikan, $peminjaman->batas_pengembalian);

    if($peminjaman->status == 0) {
        if($peminjaman->batas_pengembalian < date("Y-m-d")) {
            return rp($peminjaman->denda * $selisih_hari_ini) . " Telat $selisih_hari_ini hari";
        }
    } else if($peminjaman->status == 1) {
        if($peminjaman->batas_pengembalian < $peminjaman->tanggal_dikembalikan) {
            if($peminjaman->denda_dibayarkan == $peminjaman->denda * $selisih_tanggal_dikembalikan) {
                return rp($peminjaman->denda_dibayarkan) . " Sudah lunas";
            } else if($peminjaman->denda_dibayarkan == 0) {
                return rp($peminjaman->denda * $selisih_tanggal_dikembalikan) . " Telat $selisih_tanggal_dikembalikan hari";
            }
        }
    }

    return "Tidak ada"; 
}

function statusDetailPeminjaman($id) {
    if(get("detail_peminjaman", $id)->status == 0) {
        return "
            <p class='text-danger mb-0'>Belum dikembalikan</p>
        ";
    }
    return "
        <p class='text-success mb-0'>Sudah kembali</p>
    ";
} 

function statusPeminjamanBayarDenda($id) {
    $peminjaman = get("peminjaman", $id);

    if($peminjaman->status == 1) {
        if($peminjaman->batas_pengembalian < $peminjaman->tanggal_dikembalikan) {
            if($peminjaman->denda_dibayarkan == 0) {
                return true;
            }
        }
    }

    return false; 
}

function statusPeminjamanDisplay($id) {
    $peminjaman = get("peminjaman", $id);

    if($peminjaman->status == 0) {
        return "
            <div class='badge bg-danger text-white'>Belum dikembalikan</div>
        ";
    } else if(statusPeminjamanBayarDenda($id)) {
        return "
            <a href='#' class='badge bg-warning text-black me-1' data-bs-toggle='modal' data-bs-target='#bayardenda$id'>Belum bayar denda</a>
        ";
    }

    return "
        <div class='badge bg-success text-white'>Sudah kembali</div>
    "; 
}

function codeAnggota($id = null) {
	return generateCode("AGT", "anggota", $id);
}

function codeKelas($id = null) {
	return generateCode("KLS", "kelas_anggota", $id);
}

function codeBuku($id = null) {
    return generateCode("BKU", "buku", $id);
}

function codeKategori($id = null) {
    return generateCode("KTG", "kategori_buku", $id);
}

function codeLokasi($id = null) {
    return generateCode("LKS", "lokasi_buku", $id);
}

function codePeminjaman($id = null) {
    $char = "P" . date("Yd");
    $code = $char . sprintf("%04s", $id);
    if($id == null) {
        $latest_id = latter("peminjaman");
        $code = $char . sprintf("%04s", $latest_id + 1);
    }
    return $code;
}

function codeBukuHilang($id = null) {
    return generateCode("BKH", "buku_hilang", $id);
}

function codeKas($id = null) {
    return generateCode("KAS", "kas", $id);
}

function codePengguna($id = null) {
    return generateCode("USR", "pengguna", $id);
}

function anggotaRelational($id) {
    if(amountWhere("peminjaman", "anggota_id", $id) > 0) {
        return true;
    }  
}

function kelasRelational($id) {
    if(amountWhere("anggota", "kelas_id", $id) > 0) {
        return true;
    }  
}

function bukuRelational($id) {
    if(amountWhere("buku_hilang", "buku_id", $id) || amountWhere("detail_peminjaman", "buku_id", $id) > 0) {
        return true;
    }  
}

function kategoriRelational($id) {
    if(amountWhere("buku", "kategori_id", $id) > 0) {
        return true;
    }  
}

function lokasiRelational($id) {
    if(amountWhere("buku", "lokasi_id", $id) > 0) {
        return true;
    }  
}

function penggunaRelational($id) {
    if(amountWhere("peminjaman", "pengguna_id", $id) > 0) {
        return true;
    }  
}
