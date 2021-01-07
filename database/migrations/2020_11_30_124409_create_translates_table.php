<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translates', function (Blueprint $table) {
            $table->id();
            $table->string('id_content_trans');
            $table->longText('content');
            $table->unsignedBigInteger('tipo_content');
            $table->unsignedBigInteger('trans_lang');
            $table->string('indice_content');
            $table->longText('content_trans');
            $table->timestamps();
            $table->foreign('tipo_content')->references('id')->on('content_types')->onDelete('cascade');
            $table->foreign('trans_lang')->references('id')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translates');
    }
}
