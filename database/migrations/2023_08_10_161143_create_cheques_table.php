<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cheques', function (Blueprint $table) {
            $table->id();
            $table->string('beneficiario', 100);
            $table->string('concepto', 255);
            $table->float('monto', 8, 4);
            $table->string('estado', 50);
            $table->date('fecha');
            $table->integer('num_cheque');

            $table->unsignedBigInteger('chequera_id');
            $table->foreign('chequera_id')
                ->references('id')
                ->on('chequeras');

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
        Schema::dropIfExists('cheques');
    }
}
