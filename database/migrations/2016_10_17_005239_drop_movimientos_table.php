<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('movimiento');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::create('movimiento', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_usuario');
            $table->dateTime('responsable');
            $table->string('id_producto');
            $table->dateTime('fecha');
            $table->string('cantidad');
        });
    }
}
