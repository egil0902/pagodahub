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
        Schema::create('vales_pagodas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('value');
            $table->string('name');
            $table->string('taxid');
            $table->string('CreatedBy');
            $table->integer('AD_Org_ID');
            $table->unique('value', 'valueunique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vales_pagodas');
    }
};
