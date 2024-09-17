<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $fillable = [
        'no_inv', 'tgl_kirim', 'tgl_kirim_fix', 'pelanggan', 'produk', 'status_bayar',
        'jumlah', 'j_harga', 'satuan', 'batch', 'estimasi', 'no_hp', 'alamat', 'kabupaten',
        'provinsi', 'kabid', 'kecid', 'kota', 'kecamatan', 'kode_pos', 'produks', 'berat',
        'nilai_barang', 'pembayaran', 'jumlah_item', 'kurir', 'steril', 'block', 'follow_up',
        'keterangan', 'ongkir_real', 'waktu', 'waktu_fix', 'profit'
    ];
}

