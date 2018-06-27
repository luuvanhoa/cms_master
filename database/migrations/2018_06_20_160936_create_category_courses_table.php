<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_courses', function (Blueprint $table) {
            //Info
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('catecode');
            $table->integer('parent_id')->nullable(true)->default(0);
            $table->integer('ordering')->nullable(true)->default(10);
            $table->integer('show_frontend')->nullable(true)->default(0);
            $table->string('image')->nullable(true)->default(null);
            $table->boolean('status')->nullable(true)->default(1); // 1 show, 0 hidden
            $table->mediumText('description')->nullable(true)->default(null);
            $table->string('options')->nullable(true)->default(null);
            $table->mediumText('meta_description')->nullable(true)->default(null);
            $table->string('meta_title')->nullable(true)->default(null);
            $table->string('meta_keyword')->nullable(true)->default(null);
            $table->dateTime('created_time')->nullable(true)->default(null);
            $table->dateTime('modified_time')->nullable(true)->default(null);
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
        Schema::dropIfExists('category_courses');
    }
}
