<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyRolPermiso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       /* Schema::table('rol_permiso', function (Blueprint $table) {
            $table->foreign('rol_perm_fk_rol')->references('id')->on('rol');
            $table->foreign('rol_perm_fk_permiso')->references('id')->on('permiso');
        });*/
        
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
