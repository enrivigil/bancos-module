<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChequerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chequeras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('serie', 50);
            $table->integer('num_inicial_cheque');
            $table->integer('num_final_cheque');
            $table->integer('num_actual_cheque');

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
        Schema::dropIfExists('chequeras');
    }
}
