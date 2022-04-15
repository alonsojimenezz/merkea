<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class InitialUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@email.com',
            'password' => bcrypt('Merkea2022#'),
            'email_verified_at' => now(),
        ])->assignRole('Administrator');

        User::create([
            'name' => 'Staff',
            'email' => 'staff@email.com',
            'password' => bcrypt('Staff2022#'),
            'email_verified_at' => now(),
        ])->assignRole('Staff');

        User::create([
            'name' => 'Customer',
            'email' => 'customer@email.com',
            'password' => bcrypt('Customer2022#'),
            'email_verified_at' => now(),
        ])->assignRole('Customer');
    }
}
