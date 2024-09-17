<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('no_inv');
            $table->date('tgl_kirim');
            $table->date('tgl_kirim_fix')->nullable();
            $table->string('pelanggan');
            $table->string('produk');
            $table->enum('status_bayar', ['Lunas', 'Belum Bayar']);
            $table->integer('jumlah');
            $table->decimal('j_harga', 15, 2);
            $table->string('satuan');
            $table->string('batch');
            $table->date('estimasi');
            $table->string('no_hp');
            $table->text('alamat');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->integer('kabid');
            $table->integer('kecid');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('kode_pos');
            $table->string('produks');
            $table->decimal('berat', 8, 2);
            $table->decimal('nilai_barang', 15, 2);
            $table->string('pembayaran');
            $table->integer('jumlah_item');
            $table->string('kurir');
            $table->boolean('steril')->default(false);
            $table->boolean('block')->default(false);
            $table->boolean('follow_up')->default(false);
            $table->text('keterangan')->nullable();
            $table->decimal('ongkir_real', 15, 2)->nullable();
            $table->timestamp('waktu');
            $table->timestamp('waktu_fix')->nullable();
            $table->decimal('profit', 15, 2);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
