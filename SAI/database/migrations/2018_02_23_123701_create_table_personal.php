<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePersonal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('personal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('per_nombre',25)->nullable(false);
            $table->string('per_nombre2',25);
            $table->string('per_apellido',25)->nullable(false);
            $table->string('per_apellido2',25);
            $table->enum('per_identificador',['V','E','P'])->nullable(false);
            $table->float('per_cedula',9)->nullable(false);
            $table->date('per_fecha_nacimiento');
            $table->integer('per_fk_rol')->unsigned()->nullable(false);
            $table->decimal('per_sueldo',9,2);
            $table->string('per_direccion',250)->nullable(false);
            $table->integer('per_fk_parroquia')->unsigned()->nullable(false);
            $table->integer('per_fk_oficina')->unsigned()->nullable(false);
            $table->timestamps();


            $table->unique(['per_cedula','per_identificador'],'PERSONAL_UNIQUE_per_identificador_per_cedula');
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
        Schema::dropIfExists('personal');
    }
}
