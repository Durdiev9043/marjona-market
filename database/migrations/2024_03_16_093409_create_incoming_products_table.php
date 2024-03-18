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
        Schema::create('incoming_products', function (Blueprint $table) {
//            'product_id','count','price','total_price','tel','org','phone','zapas'
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->integer('count')->nullable();
            $table->integer('miqdori')->nullable();
            $table->integer('tel')->nullable();
            $table->double('price')->nullable();
            $table->double('total_price')->nullable();
            $table->string('org')->nullable();
            $table->string('zapas')->nullable();
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
        Schema::dropIfExists('incoming_products');
    }
};
