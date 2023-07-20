<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersetujuanBASTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persetujuan_b_a_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('beritaacara_id');
            $table->String('jabatan');
            $table->String('nama');
            $table->String('eSign')->default('Belum disetujui');
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
        Schema::dropIfExists('persetujuan_b_a_s');
    }
}
