<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableParroquia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parroquia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('par_nombre',25)->nullable(false);
            $table->integer('par_fk_municipio')->unsigned()->nullable(false);
            $table->timestamps();

            //$table->unique('par_nombre','PARROQUIA_UNIQUE_par_nombre');
            $table->unique(['par_nombre','par_fk_municipio'],'PARROQUIA_UNIQUE_par_nombre_par_fk_municipio');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parroquia');
    }
}
