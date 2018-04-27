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
            $table->decimal('cam_cantidad',9,2)->nullable(false);
            $table->date('cam_fecha')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Cambio_Bolivar');
    }
}