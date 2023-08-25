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
        Schema::table('brink', function (Blueprint $table) {
            $table->double('total_caja')->default(0.0)->nullable();
            $table->double('total')->default(0.0)->nullable();
            $table->double('total_brink')->default(0.0)->nullable();
            $table->double('total_quantity')->default(0.0)->nullable();
            $table->double('dinero_gerencia')->default(0.0)->nullable();
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
