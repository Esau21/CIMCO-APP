<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaccions', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->time('hora');
            $table->enum('tipo', ['Entrada' , 'Salida', 'Ajuste'])->default('Entrada');
            $table->string('observaciones');
            $table->unsignedBigInteger('usuarioId');
            $table->integer('proveedorId')->unsigned();


            $table->foreign('usuarioId')->references('id')->on('users');
            $table->foreign('proveedorId')->references('id')->on('proveedors');
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
        Schema::dropIfExists('transaccions');
    }
};
