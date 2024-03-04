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
        Schema::create('products', function (Blueprint $table) {
//            'name','more','price','img','count','status'
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->string('more')->nullable();
            $table->string('price');
            $table->string('img')->nullable();
            $table->string('count')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('category_id')->on('categories')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
