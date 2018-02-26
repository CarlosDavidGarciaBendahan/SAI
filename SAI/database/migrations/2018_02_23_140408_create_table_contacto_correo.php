<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContactoCorreo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto_correo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('con_cor_correo',50)->nullable(false);
            $table->integer('con_cor_fk_cliente_natural')->unsigned();
            $table->integer('con_cor_fk_cliente_juridico')->unsigned();
            $table->integer('con_cor_fk_empresa')->unsigned();
            $table->integer('con_cor_fk_personal')->unsigned();

            $table->timestamps();

            $table->unique('con_cor_correo','CONTACTO_CORREO_UNIQUE_con_cor_correo');
            $table->unique(['con_cor_fk_personal','con_cor_fk_empresa',
                            'con_cor_fk_cliente_juridico','con_cor_fk_cliente_natural',
                            'con_cor_correo'],
                            'CONTACTO_CORREO_UNIQUE_dueno');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacto_correo');
    }
}
