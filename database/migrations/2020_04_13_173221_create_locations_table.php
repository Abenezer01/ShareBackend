<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('serviceProviderId');
          $table->string('city', 100)->nullable()->default('Addis Ababa');
          $table->string('subCity', 100)->nullable()->default('null');
          $table->decimal('lng', 10, 7)->nullable();
          $table->decimal('lat', 10, 7)->nullable();
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
        Schema::dropIfExists('locations');
    }
}
