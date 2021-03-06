<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopOrderDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_order_descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id')->unsigned()->index();
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('CASCADE');
            $table->integer('shop_order_id')->unsigned()->index();
            $table->foreign('shop_order_id')->references('id')->on('shop_orders')->onDelete('CASCADE');
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
        Schema::dropIfExists('shop_order_descriptions');
    }
}
