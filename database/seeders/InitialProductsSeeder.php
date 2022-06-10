<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InitialProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Products::create([
            'UnitId' => 1,
            'CategoryId' => 121,
            'Name' => 'ABLANDADOR DE CARNE 155 G',
            'Slug' => Str::slug('ABLANDADOR DE CARNE 155 G', '-', 'es'),
            'Key' => '7501003337887',
            'Barcode' => null,
            'Image' => null,
            'Active' => true,
            'Highlight' => true
        ]);
    }
}
