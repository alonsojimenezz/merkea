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
        Schema::table('orders', function (Blueprint $table) {
            $table->bigInteger('DeliveryMethod')->after('PostalCodeId')->default(1);
            $table->dateTime('DeliveryDate')->after('DeliveryMethod')->nullable();
            $table->string('PostalCodeId')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('DeliveryMethod');
            $table->dropColumn('DeliveryDate');
            $table->string('PostalCodeId')->change();
        });
    }
};
