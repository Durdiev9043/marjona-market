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
        Schema::create('order_products', function (Blueprint $table) {
//            'product_id','count','miqdor','total_price','order_id'
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('order_id');
            $table->integer('count')->nullable();
            $table->double('miqdor')->nullable();
            $table->double('total_price');
            $table->timestamps();

            $table->foreign('order_id')->on('orders')->references('id');
            $table->foreign('product_id')->on('products')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
    }
};
