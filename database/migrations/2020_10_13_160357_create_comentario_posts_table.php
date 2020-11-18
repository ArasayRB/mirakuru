<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentarioPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentario_posts', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('fullName');
            $table->string('comment');
            $table->unsignedBigInteger('calification_id');
            $table->unsignedBigInteger('post_id');
            $table->timestamps();
            $table->foreign('calification_id')->references('id')->on('calificacion_comment_posts')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comentario_posts');
    }
}
