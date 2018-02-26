<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePcVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pc_venta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pc_ven_fk_codigopc')->unsigned()->nullable(false);
            $table->integer('pc_ven_fk_venta')->unsigned()->nullable(false);
            $table->timestamps();


            $table->unique(['pc_ven_fk_codigopc','pc_ven_fk_venta'],'PC_VENTA_UNIQUE_fk_codigopc_fk_venta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pc_venta');
    }
}
