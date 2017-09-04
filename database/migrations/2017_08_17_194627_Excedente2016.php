<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Excedente2016 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('excedente_2016', function(Blueprint $table) {
             $table->increments('id');
             $table->float('a_capital', 19, 2);
             $table->float('a_pagar', 19, 2);
             $table->string('cedula', 16);
             $table->string('codigo', 11);
             $table->string('cta_banc', 22);
             $table->float('dividen', 19, 2);
             $table->string('nombre', 60);
             $table->string('renta');
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
         Schema::dropIfExists('excedente_2016');
     }
}
