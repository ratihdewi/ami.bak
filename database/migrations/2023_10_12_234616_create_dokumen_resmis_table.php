<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenResmisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_resmis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('folderdokresmi_id');
            $table->foreign('folderdokresmi_id')->references('id')->on('folder_dokumen_resmis')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->String('fileName');
            $table->String('file');
            $table->String('owner');
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
        Schema::dropIfExists('dokumen_resmis');
    }
}
