<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeluangPeningkatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peluang_peningkatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('beritaacara_id');
            $table->String('aspek');
            $table->String('kelebihan');
            $table->text('peningkatan');
            $table->foreign('beritaacara_id')->references('id')->on('berita_acaras')->onUpdate('cascade')
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
        Schema::dropIfExists('peluang_peningkatans');
    }
}
