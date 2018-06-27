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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('username');
            $table->string('fullname');
            $table->string('email',100);
            $table->integer('status')->default(1);
            $table->integer('group_id')->default(1);
            $table->string('password', 60);
            $table->string('address')->nullable(true)->default(null);
            $table->string('phone')->nullable(true)->default(null);
            $table->date('birthday')->nullable(true)->default(null);
            $table->date('register_date')->nullable(true)->default(null);
            $table->date('last_login')->nullable(true)->default(null);
            $table->string('token_login')->nullable(true)->default(null);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
