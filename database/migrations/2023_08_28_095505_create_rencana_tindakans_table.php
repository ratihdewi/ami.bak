<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRencanaTindakansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencana_tindakans', function (Blueprint $table) {
            $table->id();
            $table->text('rencanaTindakan');
            $table->date('batasPengisian0')->default(now());
            $table->date('batasPengisian1')->default(now());
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
        Schema::dropIfExists('rencana_tindakans');
    }
}
