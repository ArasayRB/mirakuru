<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlockedDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocked_dates', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->date('date_in')->nullable();
            $table->integer('cant_days');
            $table->unsignedBigInteger('why_blocked_id');
            $table->timestamps();
            $table->foreign('why_blocked_id')->references('id')->on('why_blocked_dates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blocked_dates');
    }
}
