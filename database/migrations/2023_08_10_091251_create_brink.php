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
        Schema::create('brink', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fecha_dia');
            $table->date('fecha_cierre');
            $table->integer('billete_1');
            $table->integer('billete_5');
            $table->integer('billete_10');
            $table->integer('billete_20');
            $table->integer('rollos');
            $table->double('sencillo');
            $table->text('sucursal');
            $table->longText('foto');
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
