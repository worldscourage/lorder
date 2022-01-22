<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPriceCountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_price_count', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('order_id')->nullable(false);
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('price_id')->nullable(false);
            $table->foreign('price_id')->references('id')->on('prices');
            $table->unsignedInteger('count')->nullable(false);
            $table->float('exchange_rate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_price_count');
    }
}
