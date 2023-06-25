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
            $table->Integer('nomorButir');
            $table->String('indikatormutu');
            $table->String('targetStandar');
            $table->String('referensi');
            $table->String('keterangan');
            $table->String('pertanyaan');
            $table->text('responAuditee');
            $table->text('responAuditor');
            $table->char('inisialAuditor');
            $table->float('skorAuditor');
            $table->enum('Kategori', ['KTS','OB','Sesuai']);
            $table->String('narasiPLOR');
            $table->binary('fotoKegiatan');
            $table->binary('dokSahih');
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
