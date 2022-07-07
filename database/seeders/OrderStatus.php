<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderStatus as ModelsOrderStatus;

class OrderStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsOrderStatus::create([
            'Name' => 'Validating',
            'Color' => 'warning',
            'Active' => true
        ]);
        ModelsOrderStatus::create([
            'Name' => 'On the way',
            'Color' => 'info',
            'Active' => true
        ]);
        ModelsOrderStatus::create([
            'Name' => 'Delivered',
            'Color' => 'success',
            'Active' => true
        ]);
        ModelsOrderStatus::create([
            'Name' => 'Cancelled',
            'Color' => 'danger',
            'Active' => true
        ]);
    }
}
