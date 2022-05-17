<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BranchOffices as ModelsBranchOffices;

class InitialBranchOffice extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsBranchOffices::create([
            'Name' => 'MERKEA Mini Market Gourmet',
            'Address' => 'General Agustín de Iturbide, Sexta 2-Local 3.1, Lomas Verdes 1ra Secc, 53126 Naucalpan de Juárez, Méx.',
            'IsActive' => true,
            'Frame' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3760.5948491146064!2d-99.27873298575884!3d19.51605924306527!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d203844216d5d1%3A0xd1d0da4742b36b62!2sMERKEA%20Mini%20Market%20Gourmet!5e0!3m2!1ses-419!2smx!4v1652815597550!5m2!1ses-419!2smx" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'
        ]);
    }
}
