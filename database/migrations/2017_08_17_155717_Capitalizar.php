<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Capitalizar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capitalizar', function(Blueprint $table) {
            $table->increments('id');            
            $table->decimal('capitalizable', 19, 2);
            $table->string('cedula', 16);
            $table->string('codigo', 16);
            $table->decimal('dividendos', 19, 2);
            $table->string('nombre', 60);
            $table->decimal('renta', 19, 2);
            $table->decimal('repartible', 19, 2);
            $table->decimal('total', 19, 2);
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
        Schema::dropIfExists('capitalizar');        
    }
}
