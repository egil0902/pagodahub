<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('startbrinks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fecha');
            $table->string('responsable_entrega');
            $table->string('responsable_recibe');
            $table->double('presupuesto')->default(0.0)->nullable();
            $table->double('devolucion')->default(0.0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
