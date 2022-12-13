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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fechanuevoprestamo')->nullable();
            $table->double('monto', 8, 2)->nullable();
            $table->double('cuota', 8, 2)->nullable();
            $table->text('frecuencia')->nullable();
            $table->longText('filecedula')->nullable();
            $table->longText('firmanuevoprestamo')->nullable();
            $table->string('estado')->nullable();
            $table->string('cedula_user')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
};
