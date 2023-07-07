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
            $table->String('butirStandar');
            $table->String('nomorButir');
            $table->String('indikatormutu');
            $table->String('targetStandar')->nullable();
            $table->String('referensi');
            $table->String('keterangan');
            $table->String('pertanyaan')->nullable();
            $table->text('responAuditee')->nullable();
            $table->text('responAuditor')->nullable();
            $table->char('inisialAuditor')->nullable();
            $table->float('skorAuditor')->nullable();
            $table->enum('Kategori', ['KTS','OB','Sesuai'])->nullable();
            $table->String('approvalAuditor')->default('Belum disetujui Auditor');
            $table->String('approvalAuditee')->default('Belum disetujui Auditee');
            $table->String('narasiPLOR')->nullable();
            $table->String('fotoKegiatan')->nullable();
            $table->String('dokSahih')->nullable();
            $table->foreign('daftartilik_id')->references('id')->on('daftar_tiliks');
            $table->foreign('auditee_id')->references('id')->on('auditees');
            $table->foreign('auditor_id')->references('id')->on('auditors');
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
