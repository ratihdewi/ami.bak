<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarTiliksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_tiliks', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('auditee_id');
            $table->unsignedBigInteger('auditor_id');
            $table->String('area');
            $table->String('tempat');
            $table->Date('tgl_pelaksanaan');
            $table->Date('bataspengisianRespon');
            $table->foreign('auditee_id')->references('id')->on('auditees')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('auditor_id')->references('id')->on('auditors')->onUpdate('cascade')
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
        Schema::dropIfExists('daftar_tiliks');
    }
}
