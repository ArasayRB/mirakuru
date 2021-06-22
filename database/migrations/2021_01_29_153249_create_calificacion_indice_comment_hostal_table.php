<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalificacionIndiceCommentHostalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificacion_indice_comment_hostal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('calificacion_id');
            $table->unsignedBigInteger('indice_id');
            $table->unsignedBigInteger('comment_id');
            $table->timestamps();
            $table->foreign('calificacion_id')->references('id')->on('calificacion_comment_hostals')->onDelete('cascade');
            $table->foreign('indice_id')->references('id')->on('indice_comentario_hostals')->onDelete('cascade');
            $table->foreign('comment_id')->references('id')->on('comentario_hostals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calificacion_indice_comment_hostal');
    }
}
