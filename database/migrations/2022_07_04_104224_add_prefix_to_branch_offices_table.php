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
        Schema::table('branch_offices', function (Blueprint $table) {
            $table->string('Prefix')->default('XYZ')->after('Id');
            $table->time('OpenHours')->nullable()->after('Frame');
            $table->time('CloseHours')->nullable()->after('OpenHours');
            $table->string('Phone')->nullable()->after('CloseHours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('branch_offices', function (Blueprint $table) {
            $table->dropColumn('Prefix');
            $table->dropColumn('OpenHours');
            $table->dropColumn('CloseHours');
            $table->dropColumn('Phone');
        });
    }
};
