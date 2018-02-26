<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRolPermiso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol_permiso', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rol_per_fk_rol')->unsigned()->nullable(false);
            $table->integer('rol_per_fk_permiso')->unsigned()->nullable(false);
            $table->timestamps();

            $table->unique(['rol_per_fk_permiso','rol_per_fk_rol'],'ROL_PERMISO_UNIQUE_fk_rol_fk_permiso');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rol_permiso');
    }
}
