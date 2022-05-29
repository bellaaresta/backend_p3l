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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_driver');
            $table->string('alamat_driver');
            $table->string('tgl_lahir_driver');
            $table->string('jenis_kelamin_driver');
            $table->string('notelp_driver');
            $table->string('email_driver');
            $table->string('password_driver');
            $table->string('status_tersedia');
            $table->string('berkas_driver');
            $table->string('bahasa');
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
        Schema::dropIfExists('drivers');
    }
};
