<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => '01h7jysx7pjk7aqfcg87vazp86',
            'name' => 'Sparks',
            'company_name' => 'The Sparks Foundation',
            'company_type' => 'International',
            'email' => 'company@gmail.com',
            'phone' => '0123456789',
            'phone_sec' => null,
            'location' => 'assiut',
            'password' => bcrypt('company@gmail.com'), // Replace with the actual password
            'account_type' => 'company',
            "image" => "#",
            "property_charge" => 5,
            'created_at' => '2023-08-11 15:47:38',
            'updated_at' => '2023-08-11 15:47:38',
        ]);

        User::create([
            'id' => '01h7jwa2wgba9ydy89c935fg51',
            'name' => 'Yousef Mohamed',
            'email' => 'user@gmail.com',
            'phone' => '01145119185',
            'password' => bcrypt('user@gmail.com'),
            'account_type' => 'personal',
            "image" => "#",
            "property_charge" => 2,
            'created_at' => '2023-08-11 15:04:03',
            'updated_at' => '2023-08-11 15:04:03',
        ]);
    }
}
