<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArticuloVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo_venta', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('art_ven_fk_codigoarticulo')->unsigned()->nullable(false);
            $table->integer('art_ven_fk_venta')->unsigned()->nullable(false);
            $table->float('precio_unitario',9,2)->nullable(false);
            $table->timestamps();


            $table->unique(['art_ven_fk_codigoarticulo','art_ven_fk_venta'],'ARTICULO_VENTA_UNIQUE_fk_codigoarticulo_fk_venta');
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
        Schema::dropIfExists('articulo_venta');
    }
}
