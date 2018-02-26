<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyContactoTelefono extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacto_telefono', function (Blueprint $table) {
            $table->foreign('con_tel_fk_cliente_natural')->references('id')->on('cliente_natural');
            $table->foreign('con_tel_fk_cliente_juridico')->references('id')->on('cliente_juridico');
            $table->foreign('con_tel_fk_empresa')->references('id')->on('empresa');
            $table->foreign('con_tel_fk_personal')->references('id')->on('personal');
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
