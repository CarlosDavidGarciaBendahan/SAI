<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableModelo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mod_modelo',20)->nullable(false);
            $table->integer('mod_fk_marca')->nullable(false);
            $table->timestamps();

            $table->unique(['mod_modelo','mod_fk_marca'],'MODELO_UNIQUE_mod_modelo_mod_fk_marca');
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
        Schema::dropIfExists('modelo');
    }
}
