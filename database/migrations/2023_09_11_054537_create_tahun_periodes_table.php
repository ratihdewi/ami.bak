<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTahunPeriodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahun_periodes', function (Blueprint $table) {
            $table->id();
            $table->integer('tahunperiode1')->nullable();
            $table->integer('tahunperiode2')->nullable();
            $table->Date('tgl_mulai');
            $table->Date('tgl_berakhir');
            $table->String('keterangan');
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
        Schema::dropIfExists('tahun_periodes');
    }
}
