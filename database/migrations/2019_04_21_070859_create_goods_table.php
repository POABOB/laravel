<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('P_goods', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->Integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('P_category');
            $table->string('good_name',128);
            $table->string('image', 256);
            $table->Integer('numbers')->unsigned();
            $table->bigInteger('price')->unsigned();
            $table->string('description',256);
            $table->float('how_old')->unsigned(); //1~9.9
            //先建表 再引外鍵
            $table->Integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('P_users')->onDelete('cascade');
            $table->datetime('created_at');
            $table->datetime('updated_at');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
