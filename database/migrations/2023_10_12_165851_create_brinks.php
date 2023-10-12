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
            $table->date('fecha_dia');//
            $table->date('fecha_cierre');//
            $table->double('brinks')->default(0.0)->nullable();//
            $table->double('sencillo')->default(0.0);//
            $table->double('dinero_gerencia')->default(0.0)->nullable();//
            $table->double('facturas')->default(0.0)->nullable();//
            $table->double('banco')->default(0.0)->nullable();//
            $table->double('total_caja')->default(0.0)->nullable();//
            $table->double('total')->default(0.0)->nullable();

            $table->longText('foto');
            $table->text('sucursal');
            $table->date('fecha_inicio');//
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
