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
            $table->enum('unit_kerja',['Program Studi Ilmu Komputer', 'Fakultas Sains dan Ilmu Komputer', 'Direktorat IT']);
            $table->String('ketua_auditee');
            $table->String('jabatan_ketua_auditee');
            $table->String('ketua_auditor');
            $table->String('anggota_auditor');
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
