<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokBAAMISTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dok_b_a__a_m_i_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('beritaacara_id');
            $table->unsignedBigInteger('auditee_id');
            $table->String('judulDokumen')->default("Data judul dokumen belum ada");
            $table->String('kodeDokumen')->default("Data kode dokumen belum ada");
            $table->String('tgl_revisi')->default("Data tanggal revisi belum ada");
            $table->String('tgl_berlaku')->default("Data tanggal berlaku belum ada");
            $table->Integer('revisiKe')->default("Data jumlah revisi belum ada");
            $table->foreign('beritaacara_id')->references('id')->on('berita_acaras');
            $table->foreign('auditee_id')->references('id')->on('auditees');
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
        Schema::dropIfExists('dok_b_a__a_m_i_s');
    }
}
