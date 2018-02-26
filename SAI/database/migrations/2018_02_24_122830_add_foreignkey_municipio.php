<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyMunicipio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('municipio', function (Blueprint $table) {
            $table->foreign('mun_fk_estado')->references('id')->on('estado');
        });

        /*Schema::table('municipio', function (Blueprint $table) {
            $table->integer('mun_fk_estado')->unsigned()->nullable(false);
            $table->foreing('mun_fk_estado')->references('id')->on('estado');

            $table->unique(['mun_nombre','mun_fk_estado'],'MUNICIPIO_UNIQUE_mun_nombre_mun_fk_estado');

        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('municipio', function (Blueprint $table) {
            //
        });
    }
}
