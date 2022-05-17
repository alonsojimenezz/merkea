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
            'UnitId' => 6,
            'Key' => '7501003337887',
            'Barcode' => null,
            'BasePrice' => 20.50,
            'DiscountType' => 1,
            'DiscountPercent' => 6.00,
            'DiscountFixed' => 0,
        ]);
    }
}
