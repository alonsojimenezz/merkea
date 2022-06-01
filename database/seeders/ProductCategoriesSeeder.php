<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductCategories as ModelsProductCategories;

class ProductCategoriesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsProductCategories::create(['Name' => 'Despensa']);
        ModelsProductCategories::create(['Name' => 'Bebidas']);
        ModelsProductCategories::create(['Name' => 'Cervezas, Vinos y Licores']);
        ModelsProductCategories::create(['Name' => 'Carnes, Aves y Pescados']);
        ModelsProductCategories::create(['Name' => 'Frutas y Verduras']);
        ModelsProductCategories::create(['Name' => 'Quesos']);
        ModelsProductCategories::create(['Name' => 'Salchichoneria']);
        ModelsProductCategories::create(['Name' => 'Gourmet']);
        ModelsProductCategories::create(['Name' => 'Botanas']);
        ModelsProductCategories::create(['Name' => 'Desechables']);
        ModelsProductCategories::create(['Name' => 'Limpieza']);
        ModelsProductCategories::create(['Name' => 'Aseo Personal']);
        ModelsProductCategories::create(['Name' => 'Farmacia']);
        ModelsProductCategories::create(['Name' => 'Tabaco y Vapeadores']);
        ModelsProductCategories::create(['Name' => 'Lacteos y Huevo']);
        ModelsProductCategories::create(['Name' => 'Panaderia']);
        ModelsProductCategories::create(['Name' => 'Dulces']);
        ModelsProductCategories::create(['Name' => 'Jugos, Bebidas y Aguas']);
    }
}
