<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeywordOfertaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keyword_oferta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('oferta_id');
            $table->unsignedBigInteger('keyword_id');
            $table->timestamps();
            $table->foreign('oferta_id')->references('id')->on('ofertas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('keyword_id')->references('id')->on('keywords')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keyword_oferta');
    }
}
