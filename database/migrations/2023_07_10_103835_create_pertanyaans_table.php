<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePertanyaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertanyaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('daftartilik_id');
            $table->unsignedBigInteger('auditee_id');
            $table->unsignedBigInteger('auditor_id');
            // $table->unsignedBigInteger('beritaacara_id');
            $table->String('butirStandar')->nullable();
            $table->String('nomorButir')->nullable();
            $table->String('indikatormutu')->nullable();
            $table->String('targetStandar')->nullable();
            $table->String('referensi')->nullable();
            $table->String('keterangan')->nullable();
            $table->String('pertanyaan')->nullable();
            $table->text('responAuditee')->nullable();
            $table->text('responAuditor')->nullable();
            $table->char('inisialAuditor')->nullable();
            $table->float('skorAuditor')->nullable();
            $table->String('Kategori')->nullable();
            $table->String('approvalAuditor')->default('Belum disetujui Auditor');
            $table->String('approvalAuditee')->default('Belum disetujui Auditee');
            $table->String('narasiPLOR')->nullable();
            // $table->String('fotoKegiatan')->nullable();
            // $table->String('dokSahih')->nullable();
            $table->foreign('daftartilik_id')->references('id')->on('daftar_tiliks')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('auditee_id')->references('id')->on('auditees')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('auditor_id')->references('id')->on('auditors')->onUpdate('cascade')
            ->onDelete('cascade');
            // $table->foreign('beritaacara_id')->references('id')->on('berita_acaras');
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
        Schema::dropIfExists('pertanyaans');
    }
}