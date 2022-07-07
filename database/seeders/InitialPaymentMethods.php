<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitialPaymentMethods extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([
            'Name' => 'Efectivo contra entrega',
            'Active' => 1,
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);

        DB::table('payment_methods')->insert([
            'Name' => 'TD/TC contra entrega',
            'Active' => 1,
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);
    }
}
