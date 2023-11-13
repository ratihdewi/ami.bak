<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaAuditeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota_auditees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('auditee_id');
            $table->unsignedBigInteger('user_id');
            $table->String('anggota_auditee');
            $table->String('editor');
            $table->foreign('user_id')->references('id')->on('auditees')->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('anggota_auditees');
    }
}
