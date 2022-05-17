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
        Schema::create('product_stock_movements', function (Blueprint $table) {
            $table->id('Id');
            $table->unsignedBigInteger('UserId');
            $table->unsignedBigInteger('ProductId');
            $table->unsignedBigInteger('UnitId');
            $table->float('PreviousQuantity', 10, 2);
            $table->float('Quantity', 10, 2);
            $table->string('ReasonId');
            $table->text('Description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_stock_movements');
    }
};
