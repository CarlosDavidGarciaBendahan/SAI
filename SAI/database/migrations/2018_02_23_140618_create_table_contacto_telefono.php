<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContactoTelefono extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto_telefono', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('con_tel_tipo',['movil','local','fax'])->nullable(false);
            $table->integer('con_tel_codigo')->nullable(false);
            $table->float('con_tel_numero',7)->nullable(false);
            $table->integer('con_tel_fk_cliente_natural')->unsigned()->nullable(true);
            $table->integer('con_tel_fk_cliente_juridico')->unsigned()->nullable(true);
            $table->integer('con_tel_fk_empresa')->unsigned()->nullable(true);
            $table->integer('con_tel_fk_personal')->unsigned()->nullable(true);
            $table->timestamps();

            $table->unique(['con_tel_codigo','con_tel_numero'],'CONTACTO_TELEFONO_UNIQUE_con_tel_codigo_con_tel_numero');

            $table->unique(['con_tel_fk_personal','con_tel_fk_empresa',
                            'con_tel_fk_cliente_juridico','con_tel_fk_cliente_natural',
                            'con_tel_codigo','con_tel_numero'],
                            'CONTACTO_TELEFONO_UNIQUE_dueno');
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
        Schema::dropIfExists('contacto_telefono');
    }
}
