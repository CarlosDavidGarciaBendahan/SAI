<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyProductoDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detalle', function (Blueprint $table) {
            $table->foreign('det_fk_presupuesto')->references('id')->on('presupuesto');
            $table->foreign('det_fk_producto_computador')->references('id')->on('producto_computador');
            $table->foreign('det_fk_producto_articulo')->references('id')->on('producto_articulo');
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
