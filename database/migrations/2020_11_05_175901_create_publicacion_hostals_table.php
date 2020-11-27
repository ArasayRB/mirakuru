<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacionHostalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicacion_hostals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('img_url')->default('storage/img_web/publicacions_img/publicaFoto.jpg');
            $table->string('video_url')->nullable();
            $table->string('qr_img_url')->nullable();
            $table->boolean('publicate_state');
            $table->unsignedBigInteger('hostal_id');
            $table->text('tags');
            $table->text('slug');
            $table->text('keywords');
            $table->timestamps();
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
        Schema::dropIfExists('publicacion_hostals');
    }
}
