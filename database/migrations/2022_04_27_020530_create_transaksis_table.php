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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('no_ktp');
            $table->string('no_sim');
            $table->date('tgl_transaksi');
            $table->date('tgl_mulai_sewa');
            $table->date('tgl_selesai_sewa');
            $table->string('metode_pembayaran');
            $table->double('total_biaya_sewa');
            $table->double('ekstensi_biaya');
            $table->string('status_transaksi');
            $table->string('status_verifikasi');
            $table->integer('rating_driver');
            $table->string('jenis_transaksi');
            $table->bigInteger('id_customer')->unsigned();
            $table->bigInteger('id_driver')->unsigned()->nullable();
            $table->bigInteger('id_pegawai')->unsigned();
            $table->bigInteger('id_aset')->unsigned();
            $table->bigInteger('id_promo')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('transaksis', function (Blueprint $table) {
            $table->foreign('id_customer')->references('id')->on('customers');
        });

        Schema::table('transaksis', function (Blueprint $table) {
            $table->foreign('id_driver')->references('id')->on('drivers');
        });

        Schema::table('transaksis', function (Blueprint $table) {
            $table->foreign('id_pegawai')->references('id')->on('pegawais');
        });

        Schema::table('transaksis', function (Blueprint $table) {
            $table->foreign('id_aset')->references('id')->on('asets');
        });

        Schema::table('transaksis', function (Blueprint $table) {
            $table->foreign('id_promo')->references('id')->on('promos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
};
