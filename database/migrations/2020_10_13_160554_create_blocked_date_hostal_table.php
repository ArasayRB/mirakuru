<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlockedDateHostalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocked_date_hostal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hostal_id');
            $table->unsignedBigInteger('blocked_day_id');
            $table->boolean('active');
            $table->date('active_date');
            $table->date('inactive_date')->nullable();
            $table->timestamps();
            $table->foreign('hostal_id')->references('id')->on('hostals')->onDelete('cascade');
            $table->foreign('blocked_day_id')->references('id')->on('blocked_dates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blocked_date_hostal');
    }
}
