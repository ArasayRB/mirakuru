<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservaServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_servicio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('servicio_id');
            $table->unsignedBigInteger('reserva_id');
            $table->boolean('active');
            $table->date('active_date')->nullable();
            $table->date('inactive_date')->nullable();
            $table->integer('persons');
            $table->timestamps();
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');
            $table->foreign('reserva_id')->references('id')->on('reservas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserva_servicio');
    }
}
