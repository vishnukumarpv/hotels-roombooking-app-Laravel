<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /** 
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hotel_id')->unsigned()->index();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->integer('total_rooms')->default(0);
            $table->integer('max_person');
            $table->float('price_single',8,2);
            $table->float('price_double',8,2);
            $table->float('price_extra',8,2);
            $table->integer('discount')->nullable();
            // $table->float('child',8,2)->default(0.0);
            // $table->boolean('first_child')->default(false); 
            $table->string('slug')->unique(); 
            $table->timestamps();
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
