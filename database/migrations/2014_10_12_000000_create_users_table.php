<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->String('nip')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default('user123');
            $table->unsignedBigInteger('unitkerja_id');
            $table->string('username');
            $table->unsignedBigInteger('role_id');
            $table->string('jabatan');
            $table->String('noTelepon')->nullable();
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('unitkerja_id')->references('id')->on('unit_kerjas')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->enum('status', ['aktif', 'tidak aktif'])->default('aktif');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
