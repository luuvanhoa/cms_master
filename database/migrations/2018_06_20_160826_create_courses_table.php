<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('images')->nullable(true)->default(null);
            $table->mediumText('share_url')->nullable(true)->default(null);
            $table->integer('category_id');
            $table->string('category_fullparent')->nullable(true)->default(null);
            $table->string('catelist')->nullable(true)->default(null);
            $table->mediumText('description')->nullable(true)->default(null);
            $table->longText('content')->nullable(true)->default(null);
            $table->integer('teacher_id')->nullable(true)->default(0);
            $table->integer('price')->nullable(true)->default(0);
            $table->integer('price_old')->nullable(true)->default(0);
            $table->dateTime('start_sale')->nullable(true)->default(null);
            $table->dateTime('end_sale')->nullable(true)->default(null);
            $table->dateTime('publish_time')->nullable(true)->default(null);
            $table->integer('status')->nullable(true)->default(0);
            $table->dateTime('modified_time')->nullable(true)->default(null);
            $table->string('modified_by')->nullable(true)->default(null);
            $table->dateTime('create_time')->nullable(true)->default(null);
            $table->string('create_by')->nullable(true)->default(null);
            $table->string('meta_keyword')->nullable(true)->default(null);
            $table->string('meta_title')->nullable(true)->default(null);
            $table->string('meta_description')->nullable(true)->default(null);
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
        Schema::dropIfExists('courses');
    }
}
