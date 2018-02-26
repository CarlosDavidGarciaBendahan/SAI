<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyProductoCodigopc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('codigopc', function (Blueprint $table) {
            $table->foreign('cod_pc_fk_producto_computador')->references('id')->on('producto_computador');
            $table->foreign('cod_pc_fk_lote')->references('id')->on('lote');
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
