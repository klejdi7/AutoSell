<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id');

            $table->string('description')->nullable();
            $table->string('model');
            $table->integer('price');
            $table->float('engine');
            $table->integer('status')->default('1');
            $table->string('image')->nullable();

            $table->timestamps();
            
            $table->foreign('brand_id')->references('id')->on('brands');   
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
