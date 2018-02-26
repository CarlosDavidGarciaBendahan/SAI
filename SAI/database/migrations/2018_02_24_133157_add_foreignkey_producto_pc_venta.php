<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyProductoPcVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pc_venta', function (Blueprint $table) {
            $table->foreign('pc_ven_fk_codigopc')->references('id')->on('codigopc');
            $table->foreign('pc_ven_fk_venta')->references('id')->on('venta');
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
