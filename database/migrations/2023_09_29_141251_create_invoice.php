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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fecha_ingreso');
            $table->date('fecha_pago');            
            $table->text('proveedor')->default(0.0)->nullable();
            $table->double('monto_total')->default(0.0)->nullable();
            $table->double('monto_impuesto')->default(0.0)->nullable();
            $table->longText('foto');
            $table->text('responsable_ingreso');
            $table->text('responsable_pago');
            $table->text('forma_pago');
            $table->text('tarjeta')->nullable();
            $table->text('banco')->nullable();
            $table->text('comprobante')->nullable();
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
