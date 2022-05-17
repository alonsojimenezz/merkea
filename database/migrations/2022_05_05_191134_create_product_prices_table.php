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
        Schema::create('product_prices', function (Blueprint $table) {
            $table->id('Id');
            $table->unsignedBigInteger('LastUpdater');
            $table->unsignedBigInteger('ProductId');
            $table->unsignedBigInteger('UnitId');
            $table->string('Key')->nullable();
            $table->string('Barcode')->nullable();
            $table->float('BasePrice', 10, 2)->default(0);
            $table->integer('DiscountType')->default(0);
            $table->float('DiscountPercent', 5, 2)->default(0);
            $table->float('DiscountFixed', 10, 2)->default(0);
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
        Schema::dropIfExists('product_prices');
    }
};
