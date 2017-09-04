<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Kdxemp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('kdxemp', function(Blueprint $table) {
             $table->increments('id');
             $table->decimal('amortiza', 19, 2);
             $table->string('codigo', 16);
             $table->decimal('consec', 19, 2);
             $table->decimal('dividen', 19, 2);
             $table->dateTime('fecha');
             $table->decimal('intereses', 19, 2);
             $table->decimal('monto_cxc', 19, 2);
             $table->decimal('monto_ob', 19, 2);
             $table->decimal('monto_org', 19, 2);
             $table->decimal('monto_pa', 19, 2);
             $table->decimal('principal', 19, 2);
             $table->decimal('renta', 19, 2);
             $table->decimal('sal_cap', 19, 2);
             $table->decimal('sal_cxc', 19, 2);
             $table->decimal('sal_ob', 19, 2);
             $table->decimal('sal_pa', 19, 2);
             $table->string('tipo', 4);
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
         Schema::dropIfExists('kdxemp');
     }
}
