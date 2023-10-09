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
            $table->boolean('statusakarpenyebab')->default(false);
            $table->text('rencanaTindakan')->nullable();
            $table->boolean('statusrencanatindakan')->default(false);
            $table->text('tinjauanEfektivitas')->nullable();
            $table->boolean('statustinjauan')->default(false);
            $table->integer('persentaseSelesai')->nullable();
            $table->boolean('statusPenyelesaian')->default(false);
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
