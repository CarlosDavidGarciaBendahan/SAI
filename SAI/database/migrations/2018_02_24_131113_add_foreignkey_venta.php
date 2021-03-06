<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('venta', function (Blueprint $table) {
            $table->foreign('ven_fk_cliente_natural')->references('id')->on('cliente_natural');
            $table->foreign('ven_fk_cliente_juridico')->references('id')->on('cliente_juridico');
            $table->foreign('ven_fk_fuenteventa')->references('id')->on('fuenteventa');
            $table->foreign('ven_fk_presupuesto')->references('id')->on('presupuesto');
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
