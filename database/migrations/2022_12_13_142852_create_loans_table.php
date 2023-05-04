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
            $table->date('fechanuevoprestamo');
            $table->double('monto');
            $table->double('cuota');
            $table->text('frecuencia');
            $table->text('filecedula');
            $table->text('firmanuevoprestamo');
            $table->string('estado', 255);
            $table->string('cedula_user', 255);
            $table->string('nombre_user', 255);
            $table->string('loans_users_id', 255);
            $table->unique('loans_users_id');
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
