<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('auditee_id');
            $table->unsignedBigInteger('auditor_id');
            $table->integer('th_ajaran1')->nullable();
            $table->integer('th_ajaran2')->nullable();
            $table->String('tempat');
            $table->Date('hari_tgl');
            $table->time('waktu');
            $table->String('kegiatan');
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
        Schema::dropIfExists('jadwals');
    }
}
