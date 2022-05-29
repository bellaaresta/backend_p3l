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
        Schema::create('detail_jadwals', function (Blueprint $table) {
            $table->id();
            $table->string('hari_shift');
            $table->bigInteger('id_shift')->unsigned();
            $table->bigInteger('id_pegawai')->unsigned();
            $table->timestamps();
        });

        Schema::table('detail_jadwals', function (Blueprint $table) {
            $table->foreign('id_shift')->references('id')->on('jadwal_shifts');
        });

        Schema::table('detail_jadwals', function (Blueprint $table) {
            $table->foreign('id_pegawai')->references('id')->on('pegawais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_jadwals');
    }
};
