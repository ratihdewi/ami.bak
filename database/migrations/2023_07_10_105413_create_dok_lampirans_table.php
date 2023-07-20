<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokLampiransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dok_lampirans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('auditee_id');
            $table->String('namaDokumen');
            $table->String('kodeDokumen');
            $table->String('dokumen')->nullable();
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
        Schema::dropIfExists('dok_lampirans');
    }
}
