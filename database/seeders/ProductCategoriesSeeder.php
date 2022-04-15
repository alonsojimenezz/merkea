<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

use App\Models\ProductCategories;

class ProductCategoriesSeeder extends Seeder
{
    private $names = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 15; $i++) {

            $name = $faker->unique()->word(1);
            while ($this->isTaken($name)) {
                $name = $faker->unique()->word(1);
            }

            ProductCategories::create([
                'Name' => $name,
                'Description' => $faker->sentence(10),
            ]);
        }
    }

    private function isTaken($name)
    {
        if (in_array($name, $this->names)) {
            return true;
        } else {
            $this->names[] = $name;
            return false;
        }
    }
}
