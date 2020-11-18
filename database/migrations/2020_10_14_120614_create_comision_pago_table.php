<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComisionPagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comision_pago', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comision_id');
            $table->unsignedBigInteger('pago_id');
            $table->double('amount_comission');
            $table->timestamps();
            $table->foreign('comision_id')->references('id')->on('comisions')->onDelete('cascade');
            $table->foreign('pago_id')->references('id')->on('pagos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comision_pago');
    }
}
