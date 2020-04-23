<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRideOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ride_offers', function (Blueprint $table) {
            $table->String('id')->primary();
            $table->String('userId');
            $table->String('pickup');
            $table->String('destination');
            $table->integer('no_of_seats');
            $table->date('date');
            $table->time('time');
            $table->string('rideStatusId');
            $table->double('price');
            $table->string('vehicleId');
            $table->decimal('originLat', 10, 7);
            $table->decimal('originLong', 10, 7);
            $table->decimal('destinationLong', 10, 7);
            $table->decimal('destinationLat', 10, 7);
            $table->string('stopOver')->nullable();
            $table->foreign('userId')->references('id')->on('end_users')->onDelete('cascade');
            $table->foreign('rideStatusId')->references('rideStatusId')->on('ride_statuses')->onDelete('cascade');
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
        Schema::dropIfExists('ride_offers');
    }
}
