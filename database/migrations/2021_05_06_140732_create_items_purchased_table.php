<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsPurchasedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_purchased', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->integer('user_id');
            $table->string('car');
            $table->integer('quantity');   
            $table->integer('price');
            $table->integer('total');   
            $table->timestamps();

            $table->foreign('order_id')->references('order_id')->on('clients')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items_purchased');
    }
}
