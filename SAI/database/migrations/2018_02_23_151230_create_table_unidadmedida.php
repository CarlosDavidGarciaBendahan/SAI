<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUnidadmedida extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidadmedida', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uni_medida',10)->nullable(false);
            $table->timestamps();

            $table->unique('uni_medida','UNIDADMEDIDA_UNIQUE_uni_medida');
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
        Schema::dropIfExists('unidadmedida');
    }
}
