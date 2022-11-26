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
        Schema::table('closecashes', function (Blueprint $table) 
        {
            $table->longText('Fileclosecash')->nullable();
            $table->double( 'CardClaveFiscalizadora', 8, 2)->nullable();
            $table->double( 'CardClaveGerente', 8, 2)->nullable();  
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
