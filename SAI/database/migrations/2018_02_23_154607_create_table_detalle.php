<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('det_cantidad')->nullable(false);
            $table->float('det_total',10,2)->nullable(false);
            $table->integer('det_fk_presupuesto')->unsigned()->nullable(false);
            $table->integer('det_fk_producto_computador')->unsigned()->nullable(true);
            $table->integer('det_fk_producto_articulo')->unsigned()->nullable(true);
            $table->timestamps();

            $table->unique(['det_fk_presupuesto','det_fk_producto_computador'],'DETALLE_UNIQUE_fk_presupuesto_fk_producto_computador');

            $table->unique(['det_fk_presupuesto','det_fk_producto_articulo'],'DETALLE_UNIQUE_fk_presupuesto_fk_producto_articulo');
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
        Schema::dropIfExists('detalle');
    }
}
