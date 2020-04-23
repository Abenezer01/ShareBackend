<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserServiceProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_service_providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('serviceProviderId');
            $table->string('userId');
            $table->boolean('selcted')->default(false);
            $table->foreign('serviceProviderId')->references('id')->on('c_h_r_l_service_providers')->onDelete('cascade');
            $table->foreign('userId')->references('id')->on('end_users')->onDelete('cascade');
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
        Schema::dropIfExists('user_service_providers');
    }
}
