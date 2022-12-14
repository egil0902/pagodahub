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
        Schema::create('loans_payments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date("datepayment")->nullable();
            $table->double("amount", 8, 2)->nullable();
            $table->double("debt", 8, 2)->nullable();
            $table->string("loans_users_id")->nullable();
            $table->string("loans_id")->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans_payments');
    }
};
