<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyProductoArticuloSolicitud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articulo_solicitud', function (Blueprint $table) {
            $table->foreign('art_sol_fk_solicitud')->references('id')->on('solicitud');
            $table->foreign('art_sol_fk_codigoarticulo')->references('id')->on('codigoarticulo');
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
