<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\States as ModelsStates;

class InitialStates extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsStates::create([
            'Name' => 'Aguascalientes',
            'Abbreviation' => 'AGS',
        ]);
        ModelsStates::create([
            'Name' => 'Baja California',
            'Abbreviation' => 'BC',
        ]);
        ModelsStates::create([
            'Name' => 'Baja California Sur',
            'Abbreviation' => 'BCS',
        ]);
        ModelsStates::create([
            'Name' => 'Campeche',
            'Abbreviation' => 'CAMP',
        ]);
        ModelsStates::create([
            'Name' => 'Chiapas',
            'Abbreviation' => 'CHIS',
        ]);
        ModelsStates::create([
            'Name' => 'Chihuahua',
            'Abbreviation' => 'CHIH',
        ]);
        ModelsStates::create([
            'Name' => 'Ciudad de México',
            'Abbreviation' => 'CDMX',
        ]);
        ModelsStates::create([
            'Name' => 'Coahuila',
            'Abbreviation' => 'COAH',
        ]);
        ModelsStates::create([
            'Name' => 'Colima',
            'Abbreviation' => 'COL',
        ]);
        ModelsStates::create([
            'Name' => 'Durango',
            'Abbreviation' => 'DGO',
        ]);
        ModelsStates::create([
            'Name' => 'Guanajuato',
            'Abbreviation' => 'GTO',
        ]);
        ModelsStates::create([
            'Name' => 'Guerrero',
            'Abbreviation' => 'GRO',
        ]);

        ModelsStates::create([
            'Name' => 'Hidalgo',
            'Abbreviation' => 'HGO',
        ]);
        ModelsStates::create([
            'Name' => 'Jalisco',
            'Abbreviation' => 'JAL',
        ]);
        ModelsStates::create([
            'Name' => 'Estado de México',
            'Abbreviation' => 'MEX',
        ]);
        ModelsStates::create([
            'Name' => 'Michoacán',
            'Abbreviation' => 'MIC',
        ]);
        ModelsStates::create([
            'Name' => 'Morelos',
            'Abbreviation' => 'MOR',
        ]);
        ModelsStates::create([
            'Name' => 'Nayarit',
            'Abbreviation' => 'NAY',
        ]);
        ModelsStates::create([
            'Name' => 'Nuevo León',
            'Abbreviation' => 'NL',
        ]);
        ModelsStates::create([
            'Name' => 'Oaxaca',
            'Abbreviation' => 'OAX',
        ]);
        ModelsStates::create([
            'Name' => 'Puebla',
            'Abbreviation' => 'PUE',
        ]);
        ModelsStates::create([
            'Name' => 'Querétaro',
            'Abbreviation' => 'QRO',
        ]);
        ModelsStates::create([
            'Name' => 'Quintana Roo',
            'Abbreviation' => 'QROO',
        ]);
        ModelsStates::create([
            'Name' => 'San Luis Potosí',
            'Abbreviation' => 'SLP',
        ]);
        ModelsStates::create([
            'Name' => 'Sinaloa',
            'Abbreviation' => 'SIN',
        ]);
        ModelsStates::create([
            'Name' => 'Sonora',
            'Abbreviation' => 'SON',
        ]);
        ModelsStates::create([
            'Name' => 'Tabasco',
            'Abbreviation' => 'TAB',
        ]);
        ModelsStates::create([
            'Name' => 'Tamaulipas',
            'Abbreviation' => 'TAM',
        ]);
        ModelsStates::create([
            'Name' => 'Tlaxcala',
            'Abbreviation' => 'TLAX',
        ]);
        ModelsStates::create([
            'Name' => 'Veracruz',
            'Abbreviation' => 'VER',
        ]);
        ModelsStates::create([
            'Name' => 'Yucatán',
            'Abbreviation' => 'YUC',
        ]);
        ModelsStates::create([
            'Name' => 'Zacatecas',
            'Abbreviation' => 'ZAC',
        ]);
    }
}
