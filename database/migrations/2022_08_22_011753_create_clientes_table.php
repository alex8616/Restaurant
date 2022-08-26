<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre_cliente');
            $table->string('Apellidop_cliente');
            $table->string('Apellidom_cliente');
            $table->string('Direccion_cliente');
            $table->string('Celular_cliente');
            $table->string('FechaNacimiento_cliente');
            $table->string('Correo_cliente');
            $table->String('latidud');
            $table->String('longitud');
            $table->enum('tipo', ['SI', 'NO'])->default('NO');

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
        Schema::dropIfExists('clientes');
    }
}
