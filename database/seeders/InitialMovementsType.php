<?php

namespace Database\Seeders;

use App\Models\MovementsType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitialMovementsType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MovementsType::create(['Name' => 'Inventory Adjustment']);
        MovementsType::create(['Name' => 'Sicar Initial Inventory']);
        MovementsType::create(['Name' => 'Sicar Inventory Adjustment']);
        MovementsType::create(['Name' => 'Purchase']);
    }
}
