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
        Schema::create('vales_pagoda_ranges', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('valueFrom');
            $table->integer('valueTo');
            $table->decimal('amount');
            $table->string('CreatedBy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vales_pagoda_ranges');
    }
};
