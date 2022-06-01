<?php

namespace Database\Seeders;

use App\Models\ProductPrices;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitialProductPrices extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductPrices::create([
            'LastUpdater' => 1,
            'ProductId' => 1,
            'BasePrice' => 20.50,
            'DiscountType' => 1,
            'DiscountPercent' => 6.00,
            'DiscountFixed' => 0,
        ]);
    }
}
