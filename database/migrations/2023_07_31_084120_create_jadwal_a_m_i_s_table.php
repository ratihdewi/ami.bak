<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalAMISTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_a_m_i_s', function (Blueprint $table) {
            $table->id();
            $table->integer('th_ajaran1')->nullable();
            $table->integer('th_ajaran2')->nullable();
            $table->String('kegiatan');
            $table->String('subkegiatan')->nullable();
            $table->date('tgl_mulai');
            $table->date('tgl_berakhir');
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
        Schema::dropIfExists('jadwal_a_m_i_s');
    }
}
