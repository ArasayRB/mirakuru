<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('qr_img_web_url')->nullable();
            $table->text('description');
            $table->string('slug')->unique();
            $table->string('img_url');
            $table->unsignedBigInteger('hostal_id');
            $table->unsignedBigInteger('area_id');
            $table->boolean('ppal')->default(0);

            $table->foreign('hostal_id')->references('id')->on('hostals')->onDelete('cascade');
            $table->foreign('area_id')->references('id')->on('area_pictures')->onDelete('cascade');
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
        Schema::dropIfExists('fotos');
    }
}
