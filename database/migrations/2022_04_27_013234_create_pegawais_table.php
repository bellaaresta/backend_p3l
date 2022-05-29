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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pegawai');
            $table->string('alamat_pegawai');
            $table->string('tgl_lahir_pegawai');
            $table->string('jenis_kelamin_pegawai');
            $table->string('email_pegawai');
            $table->string('password_pegawai');
            $table->string('foto_pegawai');
            $table->bigInteger('id_role')->unsigned();
            $table->timestamps();
        });

        Schema::table('pegawais', function (Blueprint $table) {
            $table->foreign('id_role')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
};
