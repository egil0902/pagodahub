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
        Schema::create('requestbrinks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fecha');
            $table->integer('billete_1')->default(0.0)->nullable();
            $table->integer('billete_5')->default(0.0)->nullable();
            $table->integer('billete_10')->default(0.0)->nullable();
            $table->integer('billete_20')->default(0.0)->nullable();
            $table->integer('rollos_01')->default(0.0)->nullable();
            $table->double('rollos_05')->default(0.0)->nullable();
            $table->double('rollos_10')->default(0.0)->nullable();
            $table->double('rollos_25')->default(0.0)->nullable();
            $table->double('rollos_50')->default(0.0)->nullable();
            $table->double('total')->default(0.0)->nullable();
            $table->longText('foto')->nullable();
            $table->text('observaciones')->nullable();
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
