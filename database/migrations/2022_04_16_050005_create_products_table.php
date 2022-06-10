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
        Schema::create('products', function (Blueprint $table) {
            $table->id('Id');
            $table->bigInteger('UnitId')->unsigned()->nullable();
            $table->bigInteger('CategoryId')->unsigned()->nullable();
            $table->string('Name')->unique();
            $table->string('Slug')->unique();
            $table->string('Key')->nullable();
            $table->string('Barcode')->nullable();
            $table->text('Description')->nullable();
            $table->text('Image')->nullable();
            $table->boolean('Active')->default(true);
            $table->boolean('Highlight')->default(false);
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
        Schema::dropIfExists('products');
    }
};
