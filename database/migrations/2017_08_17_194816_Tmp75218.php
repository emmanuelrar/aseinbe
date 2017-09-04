<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tmp75218 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp75218', function(Blueprint $table) {
            $table->increments('id');
            $table->string('cedula', 16);
            $table->string('codigo', 16);
            $table->string('nombre', 60);
            $table->decimal('sal_cap', 19, 2);
            $table->decimal('sal_ob', 19, 2);
            $table->decimal('sal_pa', 19, 2);
            $table->decimal('sal_tot', 19, 2);
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
        Schema::dropIfExists('tmp75218');
    }
}
