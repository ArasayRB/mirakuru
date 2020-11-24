<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('img_ppal_url');
            $table->string('qr_img_web_url')->nullable();
            $table->boolean('active');
            $table->float('price',8,2);
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->unsignedBigInteger('hostal_id');
            $table->unsignedBigInteger('type_oferta_id');
            $table->text('tags');
            $table->timestamps();
            $table->foreign('hostal_id')->references('id')->on('hostals')->onDelete('cascade');
            $table->foreign('type_oferta_id')->references('id')->on('oferta_tipos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ofertas');
    }
}
