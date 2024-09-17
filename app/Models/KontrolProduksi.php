<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontrolProduksi extends Model
{
    use HasFactory;

    protected $table = 'tb_kontrol_produksi'; // Map the table name

    protected $fillable = [
        'id',
        'tanggal',
        'produk',
        'jumlah',
        'keterangan'
    ];

    // public $timestamps = false; // Disable timestamps if not required
}
