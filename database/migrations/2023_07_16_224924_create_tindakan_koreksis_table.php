<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTindakanKoreksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tindakan_koreksis', function (Blueprint $table) {
            $table->id();
            $table->integer('noPTK');
            $table->text('akarPenyebab')->nullable();
            $table->date('batasPengisian0')->nullable();
            $table->date('batasPengisian1')->nullable();
            $table->String('auditor')->nullable();
            $table->unsignedBigInteger('pertanyaan_id');
            $table->foreign('pertanyaan_id')->references('id')->on('pertanyaans')->onUpdate('cascade')
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
        Schema::dropIfExists('tindakan_koreksis');
    }
}
