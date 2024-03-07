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
            $table->tinyInteger('status');
            $table->double('lat')->nullable();
            $table->double('lang')->nullable();
            $table->string('address_name')->nullable();
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
