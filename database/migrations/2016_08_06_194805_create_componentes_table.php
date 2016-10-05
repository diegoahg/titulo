<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('componentes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_bien');
            $table->string('codigo');
            $table->string('descripcion');
            $table->string('serie');
            $table->string('marca');
            $table->string('modelo');
            $table->string('categoria');
            $table->string('tipo');
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
        Schema::drop('componentes');
    }
}
