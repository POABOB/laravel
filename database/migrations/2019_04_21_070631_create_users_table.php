<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('P_users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('student_id',8)->nullble();
            $table->string('password',256)->nullble();
            $table->string('email',128)->unique();
            $table->string('name',128);
            $table->string('cellphone',15)->nullble();
            $table->date('birthday')->nullble();
            $table->string('right',5);
            $table->string('avatar', 256);
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
        Schema::dropIfExists('sellers');
    }
}
