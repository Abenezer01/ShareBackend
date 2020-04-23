<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookRidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_rides', function (Blueprint $table) {
            $table->string('id');
            $table->string('rideOfferId');
            $table->string('rideConsumerId');
            $table->integer('totalPass');
            $table->foreign('rideOfferId')->references('id')->on('ride_offers')->onDelete('cascade');
            $table->foreign('rideConsumerId')->references('id')->on('end_users')->onDelete('cascade');
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
        Schema::dropIfExists('book_rides');
    }
}
