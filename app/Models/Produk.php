<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
     // Nama tabel
     protected $table = 'tb_barang';

     // Kolom-kolom yang bisa diisi (mass assignable)
     protected $fillable = [
         'kode',
         'tgl_terima',
         'nama_barang',
         'satuan',
         'stok',
         'harga_beli',
         'harga_jual',
         'harga_ecer',
         'h_reseller',
         'profit',
         'berat',
         'profit_reseller',
         'profit_db',
     ];
 
     // Menonaktifkan timestamps jika tidak diperlukan
     public $timestamps = true;
}
