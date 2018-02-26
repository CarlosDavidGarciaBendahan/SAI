<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyRegistropago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registropago', function (Blueprint $table) {
            $table->foreign('reg_fk_banco_origen')->references('id')->on('banco');
            $table->foreign('reg_fk_banco_destino')->references('id')->on('banco');
            $table->foreign('reg_fk_venta')->references('id')->on('venta');
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
