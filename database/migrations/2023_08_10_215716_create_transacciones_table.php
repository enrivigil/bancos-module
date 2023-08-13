<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id();
            $table->string('concepto', 255);
            $table->float('monto', 8, 4);
            $table->date('fecha');
            $table->string('tipo_transaccion', 100);
            
            $table->unsignedBigInteger('cuenta_bancaria_id');
            $table->foreign('cuenta_bancaria_id')
                ->references('id')
                ->on('cuentas_bancarias');

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
        Schema::dropIfExists('transacciones');
    }
}
