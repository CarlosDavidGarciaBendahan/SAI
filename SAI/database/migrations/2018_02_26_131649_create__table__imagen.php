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
        Schema::create('Imagen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('img_nombre')->nullable(false);
            $table->integer('img_fk_producto_computador')->unsigned();
            $table->integer('img_fk_producto_articulo')->unsigned();
            $table->timestamps();


            $table->unique('img_nombre','IMAGEN_UNIQUE_img_nombre');

            $table->foreign('img_fk_producto_articulo')->references('id')->on('producto_articulo');
            $table->foreign('img_fk_producto_computador')->references('id')->on('producto_computador');
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
