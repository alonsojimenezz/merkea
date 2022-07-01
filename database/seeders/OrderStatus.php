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
            'Name' => 'New',
            'Active' => true
        ]);
        ModelsOrderStatus::create([
            'Name' => 'Preparing the order',
            'Active' => true
        ]);
        ModelsOrderStatus::create([
            'Name' => 'On the way',
            'Active' => true
        ]);
        ModelsOrderStatus::create([
            'Name' => 'Delivered',
            'Active' => true
        ]);
        ModelsOrderStatus::create([
            'Name' => 'Cancelled',
            'Active' => true
        ]);
    }
}
