<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostalServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostal_servicio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hostal_id');
            $table->unsignedBigInteger('servicio_id');
            $table->integer('cant_personas');
            $table->boolean('active');
            $table->date('active_date');
            $table->date('inactive_date')->nullable();
            $table->timestamps();
            $table->foreign('hostal_id')->references('id')->on('hostals')->onDelete('cascade');
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hostal_servicio');
    }
}
