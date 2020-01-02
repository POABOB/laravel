<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('P_orders', function (Blueprint $table) {
            $table->string('order_id',64)->primary();
            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->Integer('cash')->unsigned();
            $table->Integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('P_users')->onDelete('cascade');
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
}
