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
        Schema::table('invoices', function (Blueprint $table) {
            $table->double('monto_7')->default(0.0)->nullable();
            $table->double('monto_10')->default(0.0)->nullable();
            $table->double('monto_15')->default(0.0)->nullable();
            $table->double('monto_impuesto_7')->default(0.0)->nullable();
            $table->double('monto_impuesto_10')->default(0.0)->nullable();
            $table->double('monto_impuesto_15')->default(0.0)->nullable();
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
