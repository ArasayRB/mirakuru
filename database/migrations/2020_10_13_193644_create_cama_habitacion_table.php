<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamaHabitacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cama_habitacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cama_id');
            $table->unsignedBigInteger('habitacion_id');
            $table->timestamps();
            $table->foreign('cama_id')->references('id')->on('camas')->onDelete('cascade');
            $table->foreign('habitacion_id')->references('id')->on('habitacions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cama_habitacion');
    }
}
