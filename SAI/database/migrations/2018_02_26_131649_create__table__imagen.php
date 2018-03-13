<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableImagen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ima_nombre')->nullable(false);
            $table->integer('ima_fk_producto_computador')->unsigned()->nullable(true);
            $table->integer('ima_fk_producto_articulo')->unsigned()->nullable(true);
            $table->timestamps();


            $table->unique('ima_nombre','IMAGEN_UNIQUE_ima_nombre');

            $table->foreign('ima_fk_producto_articulo')->references('id')->on('producto_articulo');
            $table->foreign('ima_fk_producto_computador')->references('id')->on('producto_computador');
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
        Schema::dropIfExists('Imagen');
    }
}
