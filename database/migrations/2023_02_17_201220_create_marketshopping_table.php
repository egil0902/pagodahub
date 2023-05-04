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
        Schema::create('marketshoppings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->longText('shoppingday')->nullable();
            $table->longText('buyer')->nullable();
            $table->longText('budget')->nullable();
            $table->longText('supplier')->nullable();
            $table->longText('product')->nullable();
            $table->longText('quantity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marketshoppings');
    }
};
