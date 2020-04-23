<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
          $table->string('id')->primary();
          $table->string('itemsGroupId');
          $table->string('serviceProviderId');
          $table->boolean('availability')->nullable()->default(true);
          $table->string('name', 100)->nullable()->default('');
          $table->double('price', 15, 8)->nullable();
          $table->longText('description')->nullable();
          $table->foreign('serviceProviderId')->references('id')->on('c_h_r_l_service_providers')->onDelete('cascade');
          $table->foreign('itemsGroupId')->references('id')->on('menu_item_groups')->onDelete('cascade');
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
        Schema::dropIfExists('menu_items');
    }
}
