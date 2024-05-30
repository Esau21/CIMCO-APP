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
        Schema::create('detail_transaccions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaccionId')->unsigned();
            $table->integer('productId')->unsigned();
            $table->decimal('quantity', 10, 2);
            $table->char('UCC', 12)->unique();



            $table->foreign('transaccionId')->references('id')->on('transaccions');
            $table->foreign('productId')->references('id')->on('products');
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
        Schema::dropIfExists('detail_transaccions');
    }
};
