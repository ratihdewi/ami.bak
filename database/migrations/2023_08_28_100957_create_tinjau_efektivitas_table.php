<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTinjauEfektivitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tinjau_efektivitas', function (Blueprint $table) {
            $table->id();
            $table->text('tinjauEfektivitas');
            $table->enum('status', ['selesai', 'Tidak Selesai']);
            $table->integer('persentaseSelesai');
            $table->date('batasPengisian0')->default(now());
            $table->date('batasPengisian1')->default(now());
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
        Schema::dropIfExists('tinjau_efektivitas');
    }
}
