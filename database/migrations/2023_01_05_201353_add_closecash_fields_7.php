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
        Schema::table('closecashes', function (Blueprint $table) {
            $table->string('check_x_oneamtGerente')->nullable();
            $table->string('check_x_fiveamtGerente')->nullable();
            $table->string('check_x_tenamtGerente')->nullable();
            $table->string('check_x_twentyamtGerente')->nullable();
            $table->string('check_x_fiftyamtGerente')->nullable();
            $table->string('check_x_hundredamtGerente')->nullable();
            $table->string('check_x_yappyGerente')->nullable();
            $table->string('check_x_otrosGerente')->nullable();
            $table->string('check_x_otrosprimeroGerente')->nullable();
            $table->string('check_x_valespagodaGerente')->nullable();
            $table->string('check_x_CheckAmtGerente')->nullable();
            $table->string('check_x_LotoAmtGerente')->nullable();
            $table->string('check_x_valeAmtGerente')->nullable();
            $table->string('check_x_CardClaveGerente')->nullable();
            $table->string('check_x_CardValeGerente')->nullable();
            $table->string('check_x_CardVisaGerente')->nullable();
            $table->string('check_x_CardMasterGerente')->nullable();
            $table->string('check_x_CardAEGerente')->nullable();
            $table->string('check_x_CardBACGerente')->nullable();
            $table->string('check_x_CashAmtGerente')->nullable();
            $table->string('check_x_CoinRollGerente')->nullable();
            $table->string('check_x_InvoiceAmtGerente')->nullable();
            $table->string('check_x_InvoiceAmtPropiasGerente')->nullable();
            $table->string('check_x_VoucherAmtGerente')->nullable();
            $table->string('check_x_GrantAmtGerente')->nullable();
            $table->string('check_x_totalPanaderiaGerente')->nullable();
            $table->string('check_x_totalPagatodoGerente')->nullable();
            $table->string('check_x_totalsuperGerente')->nullable();
            $table->string('check_x_dineroTaxiGerente')->nullable();
            $table->string('check_x_vueltoMercadoGerente')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('closecashes', function (Blueprint $table) {
            //
        });
    }
};
