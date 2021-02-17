<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClosePlaceHostalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('close_place_hostal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('close_place_id');
            $table->unsignedBigInteger('hostal_id');
            $table->string('distance_km');
            $table->string('distance_walking');
            $table->timestamps();
            $table->foreign('close_place_id')->references('id')->on('close_places')->onDelete('cascade');
            $table->foreign('hostal_id')->references('id')->on('hostals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('close_place_hostal');
    }
}
