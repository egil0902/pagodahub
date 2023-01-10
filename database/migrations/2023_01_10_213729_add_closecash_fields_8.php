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
            $table->double('efectivo_sistema', 8, 2)->nullable();
            $table->double('otros_sistema', 8, 2)->nullable();
            $table->double('sub_total_super_sistema', 8, 2)->nullable();
            $table->double('monto_contado_sistema', 8, 2)->nullable();
            $table->double('monto_x_sistema', 8, 2)->nullable();
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
