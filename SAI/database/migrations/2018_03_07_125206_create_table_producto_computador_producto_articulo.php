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
        Schema::create('producto_computador_producto_articulo', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('pro_com_pro_art_fk_producto_computador')->unsigned()->nullable(false);
            $table->integer('pro_com_pro_art_fk_producto_articulo')->unsigned()->nullable(false);

            $table->timestamps();


            $table->unique(['pro_com_pro_art_fk_producto_computador','pro_com_pro_art_fk_producto_articulo'],'PRODUCTO_COMPUTADOR_PRODUCTO_ARTICULO_UNIQUE_fks');


            $table->foreign('pro_com_pro_art_fk_producto_computador')->references('id')->on('producto_computador');
            $table->foreign('pro_com_pro_art_fk_producto_articulo')->references('id')->on('producto_articulo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto_computador_producto_articulo');
    }
}
