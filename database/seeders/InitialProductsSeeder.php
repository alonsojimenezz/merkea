<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitialProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Products::create(['Key' => '7501003337887', 'Name' => 'ABLANDADOR DE CARNE 155 G', 'Active' => true,]);
        Products::create(['Key' => '7501491061001', 'Name' => 'ACEITE ALEICO EN AEROSOL 380 G', 'Active' => true,]);
        Products::create(['Key' => '7502223772250', 'Name' => 'ACEITE CAPULLO 840ML', 'Active' => false,]);
    }
}
