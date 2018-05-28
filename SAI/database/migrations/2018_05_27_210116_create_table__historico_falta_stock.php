<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHistoricoFaltaStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_falta_stock', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad_faltante')->nullable(false);
            $table->float('precio_unitario',10)->nullable(false);
            $table->float('cotizacion_dolar',10)->nullable(false);
            $table->integer('fk_presupuesto')->unsigned()->nullable(false);
            $table->integer('fk_producto_computador')->unsigned()->nullable(false);
            $table->integer('fk_producto_articulo')->unsigned()->nullable(false);
            $table->timestamps();



            
            $table->foreign('fk_presupuesto')->references('id')->on('presupuesto');
            $table->foreign('fk_producto_computador')->references('id')->on('producto_computador');
            $table->foreign('fk_producto_articulo')->references('id')->on('producto_articulo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historico_falta_stock');
    }
}
