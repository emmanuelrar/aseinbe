<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Empleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function(Blueprint $table) {
            $table->increments('id');
            $table->boolean('activo');
            $table->decimal('amt_cuota', 19, 2);
            $table->decimal('ap_obrero', 19, 2);
            $table->decimal('ap_patronal', 19, 2);
            $table->string('beneficiario', 60)->nullable();
            $table->boolean('capitaliza');
            $table->decimal('capitalizado', 19, 2);
            $table->string('cedula', 16);
            $table->string('cedular', 16)->nullable();
            $table->string('ced_bene', 16)->nullable();
            $table->string('codigo', 11);
            $table->string('conyugue', 60)->nullable();
            $table->decimal('coopeflor', 19, 2);
            $table->string('cta_banc', 22);
            $table->string('direccion', 100)->nullable();
            $table->decimal('dividen_year', 19, 2);
            $table->boolean('empresa');
            $table->string('est_civil', 10)->nullable();
            $table->dateTime('fec_naci')->nullable();
            $table->dateTime('fec_pago')->nullable();
            $table->dateTime('fec_salida')->nullable();
            $table->dateTime('ingreso');
            $table->decimal('interes', 19, 2);
            $table->boolean('liquidado');
            $table->string('nacionalidad', 18)->nullable();
            $table->string('nombre', 60);
            $table->integer('num_hijos')->nullable();
            $table->string('parentesco', 14)->nullable();
            $table->decimal('saldo_cxc', 19, 2);
            $table->string('sexo', 1);
            $table->integer('sin_limite');
            $table->string('telefono', 18)->nullable();
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
        Schema::dropIdExists('empleados');
    }
}
