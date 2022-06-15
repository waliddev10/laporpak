<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPenugasanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_penugasan', function (Blueprint $table) {
            $table->id();
            $table->string('penugasan_id', 36);
            $table->string('jabatan_tim_id', 36);
            $table->string('user_id', 36);
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
        Schema::dropIfExists('user_penugasan');
    }
}
