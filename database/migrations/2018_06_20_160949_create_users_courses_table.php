<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id');
            $table->integer('user_id');
            $table->integer('status')->nullable(true)->default(0);
            $table->integer('payment')->nullable(true)->default(0);
            $table->dateTime('payment_time')->nullable(true)->default(null);
            $table->integer('payment_type')->nullable(true)->default(0);
            $table->string('note')->nullable(true)->default(null);
            $table->dateTime('modified_time')->nullable(true)->default(null);
            $table->string('modified_by')->nullable(true)->default(null);
            $table->dateTime('create_time')->nullable(true)->default(null);
            $table->string('create_by')->nullable(true)->default(null);
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
        Schema::dropIfExists('users_courses');
    }
}
