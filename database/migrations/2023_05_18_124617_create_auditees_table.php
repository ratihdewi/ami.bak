<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->String('nip');
            $table->String('unit_kerja');
            $table->String('ketua_auditee');
            $table->integer('tahunperiode')->nullable();
            $table->String('jabatan_ketua_auditee');
            $table->String('ketua_auditor');
            $table->String('anggota_auditor');
            $table->String('anggota_auditor2')->nullable();
            $table->String('anggota_auditor3')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')
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
        Schema::dropIfExists('auditees');
    }
}
