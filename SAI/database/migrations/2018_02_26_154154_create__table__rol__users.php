<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRolUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Rol_Users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rol_use_fk_rol')->unsigned()->nullable(false);
            $table->integer('rol_use_fk_users')->unsigned()->nullable(false);
            $table->timestamps();

            $table->foreign('rol_use_fk_users')->references('id')->on('users');
            $table->foreign('rol_use_fk_rol')->references('id')->on('rol');

            $table->unique(['rol_use_fk_rol','rol_use_fk_users'],
                'ROL_USERS_UNIQUE_rol_use_fk_users_rol_use_fk_rol');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Rol_Users');
    }
}
