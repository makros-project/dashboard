<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 50);
            $table->date('tgl_terima');
            $table->string('nama_barang', 25);
            $table->string('satuan', 11);
            $table->integer('stok');
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->integer('harga_ecer');
            $table->integer('h_reseller');
            $table->integer('profit');
            $table->integer('berat');
            $table->integer('profit_reseller');
            $table->integer('profit_db');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_barang');
    }
}
