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
            $table->foreign('tindakankoreksi_id')->references('id')->on('tindakan_koreksis')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->String('penandatangan');
            $table->date('tgl_tandatangan');
            $table->enum('jenis_ttd', ['0', '1', '2']);
            $table->boolean('status')->default(false);
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
