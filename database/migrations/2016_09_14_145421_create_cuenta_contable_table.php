<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentaContableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {  
        Schema::create('cuenta_contable', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->string('nombre');
            $table->integer('vida_util');
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
        Schema::drop('cuenta_contable');
    }
}
