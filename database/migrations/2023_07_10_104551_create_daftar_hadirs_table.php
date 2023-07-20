<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarHadirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_hadirs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('beritaacara_id');
            $table->String('posisi');
            $table->String('namapeserta');
            $table->String('eSign')->default('Hadir');
            $table->foreign('beritaacara_id')->references('id')->on('berita_acaras')->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('daftar_hadirs');
    }
}
