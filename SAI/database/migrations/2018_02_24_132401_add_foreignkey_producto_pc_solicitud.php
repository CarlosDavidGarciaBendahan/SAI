<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyProductoPcSolicitud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pc_solicitud', function (Blueprint $table) {
            $table->foreign('pc_sol_fk_solicitud')->references('id')->on('solicitud');
            $table->foreign('pc_sol_fk_codigopc')->references('id')->on('codigopc');
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
