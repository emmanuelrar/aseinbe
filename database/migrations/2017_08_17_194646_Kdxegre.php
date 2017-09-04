<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Kdxegre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kdxegre', function(Blueprint $table) {
            $table->increments('id');
            $table->string('cedula', 16);
            $table->decimal('consec', 19, 2);
            $table->string('cta_banc', 22);
            $table->string('detalle', 60);
            $table->dateTime('fecha');
            $table->decimal('monto', 19, 2);
            $table->string('nombre', 60);
            $table->integer('tipo_cnt');
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
        Schema::dropIfExists('kdxegre');
    }
}
