<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quantity');
            $table->decimal('total_price', 10, 2);
            $table->string('status', 16);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('food_id');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('food_id')->references('id')->on('foods');

            $table->index('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
