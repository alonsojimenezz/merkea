<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PostalCoverage as ModelsPostalCoverage;

class InitialPostalCoverage extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsPostalCoverage::create([
            'UserId' => 1,
            'StateId' => 15,
            'City' => 'Naucalpan de Juárez',
            'Colony' => 'Lomas Verdes 1ra Sección',
            'PostalCode' => '53126',
            'IsActive' => true,
        ]);
    }
}
