<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyProductoArticuloVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articulo_venta', function (Blueprint $table) {
            $table->foreign('art_ven_fk_codigoarticulo')->references('id')->on('codigoarticulo');
            $table->foreign('art_ven_fk_venta')->references('id')->on('venta');
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
