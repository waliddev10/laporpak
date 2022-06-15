<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenugasanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penugasan', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 64);
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->string('keterangan', 128);
            $table->string('lokasi', 128);
            $table->string('jenis_penugasan_id', 36);
            $table->string('kategori_penugasan_id', 36);
            $table->string('skpd_id', 36);
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
        Schema::dropIfExists('penugasan');
    }
}
