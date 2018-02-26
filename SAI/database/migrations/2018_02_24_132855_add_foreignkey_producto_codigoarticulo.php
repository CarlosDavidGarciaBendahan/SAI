<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyProductoCodigoarticulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('codigoarticulo', function (Blueprint $table) {
            $table->foreign('cod_art_fk_lote')->references('id')->on('lote');
            $table->foreign('cod_art_fk_pc')->references('id')->on('codigopc');
            $table->foreign('cod_art_fk_producto_articulo')->references('id')->on('producto_articulo');
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
