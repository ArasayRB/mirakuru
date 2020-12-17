<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('noticia');
            $table->boolean('publicate_state');
            $table->integer('cant_access_read')->nullable();
            $table->integer('cant_likes')->nullable();
            $table->integer('cant_shares')->nullable();
            $table->string('img_url')->default('newFoto.jpg');
            $table->string('video_url')->nullable();
            $table->string('qr_img_url')->nullable();
            $table->unsignedBigInteger('tema_id');
            $table->unsignedBigInteger('hostal_id');
            $table->text('tags');
            $table->text('slug');
            $table->text('keywords');
            $table->timestamps();
            $table->foreign('tema_id')->references('id')->on('tema_noticias')->onDelete('cascade');
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
        Schema::dropIfExists('noticias');
    }
}
