<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->date('date_in');
            $table->date('date_out');
            $table->unsignedBigInteger('user_id');
            $table->integer('totally_persons');
            $table->unsignedBigInteger('country_id');
            $table->integer('child')->default(0);
            $table->string('service')->nullable();
            $table->string('name');
            $table->string('rooms');
            $table->string('adress');
            $table->string('phone');
            $table->boolean('active');
            $table->double('amount',8,2);
            $table->unsignedBigInteger('hostal_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('hostal_id')->references('id')->on('hostals')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
