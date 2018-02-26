<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMunicipio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mun_nombre',25)->nullable(false);
            $table->integer('mun_fk_estado')->unsigned()->nullable(false);
            $table->timestamps();


            //$table->unique('mun_nombre','MUNICIPIO_UNIQUE_mun_nombre');
            $table->unique(['mun_nombre','mun_fk_estado'],'MUNICIPIO_UNIQUE_mun_nombre_mun_fk_estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('municipio');
    }
}
