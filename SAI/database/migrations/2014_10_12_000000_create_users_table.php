<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('password');
            $table->integer('activa')->default(1);
            $table->integer('fk_personal')->unsigned()->nullable(false);
            //$table->integer('fk_rol')->unsigned()->nullable(false);
            $table->rememberToken();
            $table->timestamps();

            $table->unique('name','USERS_UNIQUE_name');
            $table->unique('fk_personal','USERS_UNIQUE_fk_personal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('users');
    }
}
