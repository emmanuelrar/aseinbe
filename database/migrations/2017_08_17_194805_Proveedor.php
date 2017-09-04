<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Proveedor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor', function(Blueprint $table) {
            $table->increments('id');
            $table->string('cedula', 16);
            $table->string('codigo', 16);
            $table->string('cta_banc', 22);
            $table->decimal('monto');
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
        Schema::dropIfExists('proveedor');
    }
}
