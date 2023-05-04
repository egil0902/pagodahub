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
        Schema::create('closecashes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->double('x_oneamtSistema', 8, 2)->nullable();
            $table->double('x_fiveamtSistema', 8, 2)->nullable();
            $table->double('x_tenamtSistema', 8, 2)->nullable();
            $table->double('x_twentyamtSistema',  8, 2)->nullable();
            $table->double('x_fiftyamtSistema',  8, 2)->nullable();
            $table->double('x_hundredamtSistema', 8, 2)->nullable();
            $table->double('yappySistema', 8, 2)->nullable();
            $table->double('otrosSistema', 8, 2)->nullable();
            $table->double('valespagodaSistema', 8, 2)->nullable();
            $table->double('CheckAmtSistema', 8, 2)->nullable();
            $table->double('LotoAmtSistema', 8, 2)->nullable();
            $table->double('CardAmtSistema', 8, 2)->nullable();
            $table->double('CashAmtSistema', 8, 2)->nullable();
            $table->double('CoinRollSistema', 8, 2)->nullable();
            $table->double('InvoiceAmtSistema', 8, 2)->nullable();
            $table->double('VoucherAmtSistema', 8, 2)->nullable();
            $table->double('GrantAmtSistema', 8, 2)->nullable();

            $table->double('x_oneamtFiscalizadora', 8, 2)->nullable();
            $table->double( 'x_fiveamtFiscalizadora', 8, 2)->nullable();  
            $table->double( 'x_tenamtFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'x_twentyamtFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'x_fiftyamtFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'x_hundredamtFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'yappyFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'otrosFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'valespagodaFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'CheckAmtFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'LotoAmtFiscalizadora', 8, 2)->nullable(); 

            $table->double( 'CardValeFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'CardVisaFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'CardMasterFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'CardAEFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'CashAmtFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'CoinRollFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'InvoiceAmtFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'VoucherAmtFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'GrantAmtFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'totalPanaderiaFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'totalPagatodoFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'totalsuperFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'dineroTaxiFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'vueltoMercadoFiscalizadora', 8, 2)->nullable(); 
            $table->text( 'comentariosFiscalizadora')->nullable(); 
            $table->double( 'x_oneamtGerente', 8, 2)->nullable();  
            $table->double( 'x_fiveamtGerente', 8, 2)->nullable();  
            $table->double( 'x_tenamtGerente', 8, 2)->nullable(); 
            $table->double( 'x_twentyamtGerente', 8, 2)->nullable();  
            $table->double( 'x_fiftyamtGerente', 8, 2)->nullable();  
            $table->double( 'x_hundredamtGerente', 8, 2)->nullable(); 
            $table->double( 'yappyGerente', 8, 2)->nullable(); 
            $table->double( 'otrosGerente', 8, 2)->nullable();  
            $table->double( 'valespagodaGerente', 8, 2)->nullable();  
            $table->double( 'CheckAmtGerente', 8, 2)->nullable(); 
            $table->double( 'LotoAmtGerente', 8, 2)->nullable();  
            $table->double( 'CardValeGerente', 8, 2)->nullable();  
            $table->double( 'CardVisaGerente', 8, 2)->nullable(); 
            $table->double( 'CardMasterGerente', 8, 2)->nullable(); 
            $table->double( 'CardAEGerente', 8, 2)->nullable(); 
            $table->double( 'CashAmtGerente', 8, 2)->nullable(); 
            $table->double( 'CoinRollGerente', 8, 2)->nullable(); 
            $table->double( 'InvoiceAmtGerente', 8, 2)->nullable(); 
            $table->double( 'VoucherAmtGerente', 8, 2)->nullable(); 
            $table->double( 'GrantAmtGerente', 8, 2)->nullable(); 
            $table->double( 'totalPanaderiaGerente', 8, 2)->nullable(); 
            $table->double( 'totalPagatodoGerente', 8, 2)->nullable(); 
            $table->double( 'totalsuperGerente', 8, 2)->nullable(); 
            $table->double( 'dineroTaxiGerente', 8, 2)->nullable(); 
            $table->double( 'vueltoMercadoGerente', 8, 2)->nullable();
            $table->text( 'comentariosGerente')->nullable();

            $table->date('DateTrx');
            $table->integer('AD_Org_ID');  

            $table->longText('Fileclosecash')->nullable();
            $table->double( 'CardClaveFiscalizadora', 8, 2)->nullable();
            $table->double( 'CardClaveGerente', 8, 2)->nullable(); 
            
            $table->double('valeAmt', 8, 2)->nullable();
            $table->double('valeAmtFiscalizadora', 8, 2)->nullable();
            $table->double('valeAmtGerente', 8, 2)->nullable();   

            $table->double( 'CardBACFiscalizadora', 8, 2)->nullable();
            $table->double( 'CardBACGerente', 8, 2)->nullable();  
            $table->double( 'InvoiceAmtPropiasFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'InvoiceAmtPropiasGerente', 8, 2)->nullable(); 

            $table->double( 'otrosprimeroFiscalizadora', 8, 2)->nullable(); 
            $table->double( 'otrosprimeroGerente', 8, 2)->nullable(); 

            $table->string('check_fis')->nullable();
            $table->string('check_ger')->nullable();

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

            $table->double('efectivo_sistema', 8, 2)->nullable();
            $table->double('otros_sistema', 8, 2)->nullable();
            $table->double('sub_total_super_sistema', 8, 2)->nullable();
            $table->double('monto_contado_sistema', 8, 2)->nullable();
            $table->double('monto_x_sistema', 8, 2)->nullable();

            $table->double('SencilloSupervisoraFiscalizadora', 8, 2)->nullable();
            $table->double('SencilloSupervisoraGerente', 8, 2)->nullable();

            $table->string('check_SencilloSupervisoraGerente')->nullable();

        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('closecashes');
    }
};
