<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCambioBolivar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cambio_bolivar', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('precio_dolar',9,2)->nullable(false);
            $table->date('fecha')->nullable(false);
            $table->timestamps();


            $table->unique('fecha','CAMBIO_BOLIVAR_U_fecha');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cambio_bolivar');
    }
}
