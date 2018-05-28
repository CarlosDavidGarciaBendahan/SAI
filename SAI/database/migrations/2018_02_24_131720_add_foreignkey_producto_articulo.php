<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyProductoArticulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('producto_articulo', function (Blueprint $table) {
            $table->foreign('pro_art_fk_unidadmedida')->references('id')->on('unidadmedida');
            $table->foreign('pro_art_fk_sector')->references('id')->on('sector');
            $table->foreign('pro_art_fk_modelo')->references('id')->on('modelo');
            $table->foreign('pro_art_fk_tipo_producto')->references('id')->on('tipo_producto');

        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
