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
        Schema::create('orders', function (Blueprint $table) {
//            'user_id','status','lat','lang','address_name'
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->integer('status');
            $table->double('lat')->nullable();
            $table->double('lang')->nullable();
            $table->string('address_name')->nullable();
            $table->tinyInteger('type')->nullable();
            $table->tinyInteger('pay_type')->nullable();

            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('supplier_id')->on('users')->references('id');
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
        Schema::dropIfExists('orders');
    }
};
