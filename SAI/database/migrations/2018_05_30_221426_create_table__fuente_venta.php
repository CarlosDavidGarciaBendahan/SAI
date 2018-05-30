<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFuenteVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuenteventa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',25)->nullable(false);
            $table->string('descripcion',50)->nullable(false);
            $table->timestamps();


            $table->unique('nombre','FUENTEVENTA_U_nombre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuenteventa');
    }
}
