<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersetujuanTindakanKoreksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persetujuan_tindakan_koreksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tindakankoreksi_id');
            $table->unsignedBigInteger('rencanatindakan_id');
            $table->unsignedBigInteger('tinjauanEfektivitas_id');
            $table->foreign('tinjauanEfektivitas_id')->references('id')->on('tinjau_efektivitas')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('rencanatindakan_id')->references('id')->on('rencana_tindakans')->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('persetujuan_tindakan_koreksis');
    }
}
