<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaccionDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaccion_detalles', function (Blueprint $table) {
            $table->id();
            $table->string('concepto', 255);
            $table->string('codigo_conta', 12);
            $table->string('cuenta_conta', 100);
            $table->float('debe', 8, 4);
            $table->float('haber', 8, 4);

            $table->unsignedBigInteger('transaccion_id');
            $table->foreign('transaccion_id')
                ->references('id')
                ->on('transacciones');
                
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
        Schema::dropIfExists('transaccion_detalles');
    }
}
