<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyPresupuesto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presupuesto', function (Blueprint $table) {
            $table->foreign('pre_fk_empresa')->references('id')->on('empresa');
            $table->foreign('pre_fk_cliente_natural')->references('id')->on('cliente_natural');
            $table->foreign('pre_fk_cliente_juridico')->references('id')->on('cliente_juridico');
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
