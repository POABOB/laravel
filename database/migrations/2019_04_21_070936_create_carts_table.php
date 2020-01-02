<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('P_carts', function (Blueprint $table) {
            // $table->increments('id');
            $table->Integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('P_users');
            $table->Integer('good_id')->unsigned();
            $table->foreign('good_id')->references('id')->on('P_goods');
            
            // //app
            // $table->string('orderId', 128);
            // $table->string('ShipperEmail', 128);
            // $table->float('lat');
            // $table->float('lng');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
