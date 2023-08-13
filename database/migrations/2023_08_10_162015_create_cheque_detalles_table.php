<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChequeDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cheque_detalles', function (Blueprint $table) {
            $table->id();
            $table->string('concepto', 255);
            $table->string('codigo_conta', 12);
            $table->string('cuenta_conta', 100);
            $table->float('debe', 8, 4);
            $table->float('haber', 8, 4);
            $table->string('ref');

            $table->unsignedBigInteger('cheque_id');
            $table->foreign('cheque_id')
                ->references('id')
                ->on('cheques');
                
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
        Schema::dropIfExists('cheque_detalles');
    }
}
