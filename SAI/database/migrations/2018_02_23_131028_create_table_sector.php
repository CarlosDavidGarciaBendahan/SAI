<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSector extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sector', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sec_sector',10)->nullable(false);
            $table->integer('sec_fk_oficina')->unsigned()->nullable(false);
            $table->timestamps();

            $table->unique(['sec_sector','sec_fk_oficina'],'SECTOR_UNIQUE_sec_sector_sec_fk_oficina');
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
        Schema::dropIfExists('sector');
    }
}
