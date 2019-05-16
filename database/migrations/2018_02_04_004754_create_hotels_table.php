<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('created_by');
            $table->integer('cat_id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('address');
            $table->string('street');
            $table->string('city');
            $table->integer('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('web')->nullable(); 
            $table->string('slug')->unique();
            $table->boolean('is_active')->default(false);
            $table->string('location',100)->nullable(); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('hotels');
    }
}
