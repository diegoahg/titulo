<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBienRegistroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bien_registro', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('correlativo');
            $table->string('codigo');
            $table->string('descripcion');
            $table->integer('cantidad');
            $table->bigInteger('valor');
            $table->string('orden_compra');
            $table->string('fecha_incorporacion');
            $table->integer('id_centro');
            $table->integer('id_sector');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bien_registro');
    }
}
