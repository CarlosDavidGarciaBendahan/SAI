<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyContactoCorreo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacto_correo', function (Blueprint $table) {
            $table->foreign('con_cor_fk_cliente_natural')->references('id')->on('cliente_natural');
            $table->foreign('con_cor_fk_cliente_juridico')->references('id')->on('cliente_juridico');
            $table->foreign('con_cor_fk_empresa')->references('id')->on('empresa');
            $table->foreign('con_cor_fk_personal')->references('id')->on('personal');
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
