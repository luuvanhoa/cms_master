<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Lectures
        Schema::create('courses_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('course_id');
            $table->integer('parent_id')->nullable(true)->default(0);
            $table->integer('level')->nullable(true)->default(0);
            $table->string('file_name')->nullable(true)->default(null);
            $table->integer('total_duration')->nullable(true)->default(0);
            $table->integer('total_lesson')->nullable(true)->default(0);
            $table->integer('ordering')->nullable(true)->default(0);
            $table->integer('status')->nullable(true)->default(0);
            $table->string('certificate')->nullable(true)->default(null); // cấp giấy chứng nhận
            $table->string('level_learn')->nullable(true)->default(null); // Mô tả level học
            $table->string('description')->nullable(true)->default(null); // Mô tả cho bài học or Khóa học
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
        Schema::dropIfExists('courses_detail');
    }
}
