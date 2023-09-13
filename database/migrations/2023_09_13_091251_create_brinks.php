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
        Schema::create('brinks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fecha_dia');
            $table->date('fecha_cierre');            
            $table->integer('billete_1')->default(0.0)->nullable();
            $table->integer('billete_5')->default(0.0)->nullable();
            $table->integer('billete_10')->default(0.0)->nullable();
            $table->integer('billete_20')->default(0.0)->nullable();
            $table->integer('rollos_01')->default(0.0)->nullable();
            $table->double('rollos_05')->default(0.0)->nullable();
            $table->double('rollos_10')->default(0.0)->nullable();
            $table->double('rollos_25')->default(0.0)->nullable();
            $table->double('rollos_50')->default(0.0)->nullable();
            $table->double('sencillo');
            $table->longText('foto');
            $table->text('sucursal');
            $table->double('total_caja')->default(0.0)->nullable();
            $table->double('total')->default(0.0)->nullable();
            $table->double('total_brink')->default(0.0)->nullable();
            $table->double('total_quantity')->default(0.0)->nullable();
            $table->double('dinero_gerencia')->default(0.0)->nullable();
            $table->date('fecha_inicio');
            $table->longText('cheques')->nullable();
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
