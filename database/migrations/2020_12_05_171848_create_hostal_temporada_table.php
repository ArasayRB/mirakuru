<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostalTemporadaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostal_temporada', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hostal_id');
            $table->unsignedBigInteger('temporada_id');
            $table->boolean('active');
            $table->date('active_date');
            $table->date('inactive_date')->nullable();
            $table->timestamps();
            $table->foreign('hostal_id')->references('id')->on('hostals')->onDelete('cascade');
            $table->foreign('temporada_id')->references('id')->on('temporadas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hostal_temporada');
    }
}
