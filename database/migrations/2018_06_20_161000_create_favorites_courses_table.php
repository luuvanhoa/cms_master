<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoritesCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id');
            $table->integer('user_id');
            $table->integer('status')->nullable(true)->default(0);
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
        Schema::dropIfExists('favorites_courses');
    }
}
