<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('coupon')->nullable();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('percentage')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('amount_min')->nullable();
            $table->integer('amount_max')->nullable();
            $table->integer('max_use')->nullable();
            $table->integer('max')->nullable();
            $table->string('rule')->nullable();
            $table->string('more')->nullable();
            $table->date('valid_from');
            $table->date('valid_to');
            $table->boolean('active');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
