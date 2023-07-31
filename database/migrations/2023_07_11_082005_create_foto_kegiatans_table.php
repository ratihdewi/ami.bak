<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->String('foto');
            $table->String('namaFile')->nullable();
            $table->unsignedBigInteger('auditee_id');
            $table->foreign('auditee_id')->references('id')->on('auditees')->onUpdate('cascade')
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
        Schema::dropIfExists('foto_kegiatans');
    }
}
