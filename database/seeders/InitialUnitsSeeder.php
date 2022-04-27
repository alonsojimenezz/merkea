<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Units;

class InitialUnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Units::create(['Name' => 'Kilogramo', 'Key' => 'kg', 'Active' => true,]);
        Units::create(['Name' => 'Litro', 'Key' => 'l', 'Active' => true,]);
        Units::create(['Name' => 'Unidad', 'Key' => 'U', 'Active' => true,]);
        Units::create(['Name' => 'Gramo', 'Key' => 'g', 'Active' => true,]);
        Units::create(['Name' => 'Mililitro', 'Key' => 'ml', 'Active' => true,]);
        Units::create(['Name' => 'Pieza', 'Key' => 'pz', 'Active' => true,]);
    }
}
