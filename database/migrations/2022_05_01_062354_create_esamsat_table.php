<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEsamsatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('esamsat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_pkb_id');
            $table->date('tgl_cetak');
            $table->date('tgl_bayar');
            $table->unsignedBigInteger('no_skpd');
            $table->string('awalan_no_pol');
            $table->unsignedBigInteger('no_pol');
            $table->string('akhiran_no_pol');
            $table->unsignedBigInteger('nilai_pokok');
            $table->unsignedBigInteger('nilai_denda');
            $table->unsignedBigInteger('payment_point_id');
            $table->unsignedBigInteger('wilayah_id');
            $table->unsignedBigInteger('kasir_id');
            $table->boolean('status_esamsat')->default(false);
            $table->unsignedBigInteger('kasir_pembayaran_id')->nullable();
            $table->timestamps();

            $table->foreign('payment_point_id')
                ->references('id')
                ->on('payment_point')
                ->onDelete('cascade');
            $table->foreign('wilayah_id')
                ->references('id')
                ->on('wilayah')
                ->onDelete('cascade');
            $table->foreign('jenis_pkb_id')
                ->references('id')
                ->on('jenis_pkb')
                ->onDelete('cascade');
            $table->foreign('kasir_id')
                ->references('id')
                ->on('kasir')
                ->onDelete('cascade');
            $table->foreign('kasir_pembayaran_id')
                ->references('id')
                ->on('kasir_pembayaran')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('esamsat');
    }
}
