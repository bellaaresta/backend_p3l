<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asets', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mobil');
            $table->string('tipe_mobil');
            $table->string('jenis_transmisi');
            $table->double('volume_bahan_bakar');
            $table->string('warna_mobil');
            $table->integer('kapasitas_mobil');
            $table->string('fasilitas_mobil');
            $table->string('plat_nomor');
            $table->string('no_stnk');
            $table->string('kategori_aset');
            $table->string('tgl_service_akhir');
            $table->string('status_ketersediaan');
            $table->double('biaya_sewa');
            $table->bigInteger('id_mitra')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('asets', function (Blueprint $table) {
            $table->foreign('id_mitra')->references('id')->on('mitras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asets');
    }
};
