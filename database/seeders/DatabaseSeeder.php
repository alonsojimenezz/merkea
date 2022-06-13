<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            InitialRoleSeeder::class,
            InitialUsersSeeder::class,
            ProductCategoriesSeeder::class,
            InitialProductsSeeder::class,
            InitialUnitsSeeder::class,
            InitialProductPrices::class,
            InitialStates::class,
            InitialPostalCoverage::class,
            InitialBranchOffice::class,
            InitialMovementsType::class,
        ]);
    }
}
