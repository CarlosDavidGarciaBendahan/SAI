<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProductoComputadorProductoArticulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computador_articulo', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('com_art_fk_producto_computador')->unsigned()->nullable(false);
            $table->integer('com_art_fk_producto_articulo')->unsigned()->nullable(false);

            $table->timestamps();


            $table->unique(['com_art_fk_producto_computador','com_art_fk_producto_articulo'],'PRODUCTO_COMPUTADOR_PRODUCTO_ARTICULO_UNIQUE_fks');


            
            $table->foreign('com_art_fk_producto_articulo')->references('id')->on('producto_articulo');
            $table->foreign('com_art_fk_producto_computador')->references('id')->on('producto_computador');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('computador_articulo');
    }
}
