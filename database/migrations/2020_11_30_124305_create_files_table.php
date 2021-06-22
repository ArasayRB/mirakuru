<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('file');
            $table->longText('description');
            $table->string('slug');
            $table->string('extencion');
            $table->integer('downloads')->nullable();
            $table->integer('shares')->nullable();
            $table->integer('watches')->nullable();
            $table->unsignedBigInteger('file_type');
            $table->timestamps();
            $table->foreign('file_type')->references('id')->on('file_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
