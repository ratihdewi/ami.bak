<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeadlineTindakanKoreksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deadline_tindakan_koreksis', function (Blueprint $table) {
            $table->id();
            $table->String('penandatangan');
            $table->date('tgl_mulaipenandatangan');
            $table->date('batas_penandatanganan');
            $table->enum('peruntukan', ['0', '1', '2']);
            $table->unsignedBigInteger('tindakankoreksi_id');
            $table->foreign('tindakankoreksi_id')->references('id')->on('tindakan_koreksis')->onUpdate('cascade')
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
        Schema::dropIfExists('deadline_tindakan_koreksis');
    }
}
