<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indonesia extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang sesuai
    protected $table = 'tb_indonesia';

    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'Provinsi', 'Kabupaten', 'Kecamatan', 'KodePos', 'KecID'
    ];

    // Jika tidak menggunakan timestamps di tabel, nonaktifkan
    // public $timestamps = false;

    // Jika primary key bukan `id`, tentukan primary key
    // protected $primaryKey = 'KecID';

    // Jika primary key bukan integer, tambahkan ini
    // protected $keyType = 'string';
}
