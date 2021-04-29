<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelacionPizzaIngrediente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizza_ingerdiente', function (Blueprint $table) {
            $table->unsignedBigInteger('pizza_id');
            $table->foreign('pizza_id')
                ->references('id')
                ->on('pizzas')
                ->onDelete('cascade');

            $table->unsignedBigInteger('ingrediente_id');
            $table->foreign('ingrediente_id')
                ->references('id')
                ->on('ingredientes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
