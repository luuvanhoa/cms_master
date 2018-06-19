<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail_product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->nullable(true)->default(null);
            $table->string('phone')->nullable(true)->default(null);
            $table->string('address')->nullable(true)->default(null);
            $table->string('total_payment')->nullable(true)->default(null);
            $table->string('note')->nullable(true)->default(null);
            $table->integer('status')->nullable(true)->default(1);
            $table->dateTime('created_time');
            $table->dateTime('modified_time')->nullable(true)->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_detail_product');
    }
}
