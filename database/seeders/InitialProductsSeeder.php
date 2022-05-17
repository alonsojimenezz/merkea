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
        Products::create(['Name' => 'ABLANDADOR DE CARNE 155 G', 'Slug' => Str::slug('ABLANDADOR DE CARNE 155 G', '-', 'es'), 'Image' => null, 'Active' => true,]);
        Products::create(['Name' => 'ACEITE ALEICO EN AEROSOL 380 G', 'Slug' => Str::slug('ACEITE ALEICO EN AEROSOL 380 G', '-', 'es'), 'Image' => null, 'Active' => true,]);
        Products::create(['Name' => 'ACEITE CAPULLO 840ML', 'Slug' => Str::slug('ACEITE CAPULLO 840ML', '-', 'es'), 'Image' => null, 'Active' => false,]);
    }
}
