<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosBancariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos_bancarios', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 255);
            $table->float('monto', 8, 4);
            $table->date('fecha');
            $table->string('ref');
            $table->string('tipo_movimiento', 50);
            $table->boolean('conciliado')->default(false);

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
        Schema::dropIfExists('movimientos_bancarios');
    }
}
