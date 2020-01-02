<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('P_orderitems', function (Blueprint $table) {
            $table->string('order_id', 64);
            $table->foreign('order_id')->references('order_id')->on('P_orders')->onDelete('cascade');
            $table->Integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('P_carts');
            $table->Integer('good_id')->unsigned();
            $table->foreign('good_id')->references('good_id')->on('P_carts');
            $table->Integer('numbers')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderitems');
    }
}
