<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConciliacionBancariaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conciliacion_bancaria_detalles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('conciliacion_bancaria_id');
            $table->foreign('conciliacion_bancaria_id')
                ->references('id')
                ->on('conciliaciones_bancarias');

            $table->unsignedBigInteger('movimiento_bancario_id');
            $table->foreign('movimiento_bancario_id')
                ->references('id')
                ->on('movimientos_bancarios');

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
        Schema::dropIfExists('conciliacion_bancaria_detalles');
    }
}
