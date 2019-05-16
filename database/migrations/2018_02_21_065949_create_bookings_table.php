<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('room_id')->unsigned()->index();
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('rooms'); 
            $table->string('alignment',1000)->nullable();
            $table->string('refference')->unique();
            $table->boolean('completed')->default(0);
            $table->longtext('data')->nullable();
            $table->float('amount',25,5);
            $table->boolean('vacated')->default(false);
            $table->integer('discount_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('room_id')->references('id')->on('rooms');
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
        Schema::dropIfExists('bookings');
    }
}
