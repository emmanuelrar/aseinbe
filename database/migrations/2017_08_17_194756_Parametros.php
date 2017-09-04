<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Parametros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametros', function(BLueprint $table) {
            $table->increments('id');
            $table->string('banco', 100);
            $table->decimal('capitaliza', 19, 2);
            $table->string('cedula', 16);
            $table->decimal('max_presta', 19, 2);
            $table->string('no_cuenta', 22);
            $table->string('presidente', 60);
            $table->string('razon_soc', 60);
            $table->decimal('renta', 19, 2);
            $table->string('tesorero', 60);
            $table->string('vicepresidente', 60);
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
        Schema::dropIfExists('parametros');
    }
}
