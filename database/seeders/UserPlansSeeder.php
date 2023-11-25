<?php

namespace Database\Seeders;

use App\Models\UserPlans;
use Illuminate\Database\Seeder;

class UserPlansSeeder extends Seeder
{
    public function run(): void
    {
        UserPlans::create([
            "days_num" => 2,
            "social_media_appear" => 18000,
            "price" => 250,
        ]);
        UserPlans::create([
            "days_num" => 4,
            "social_media_appear" => 36000,
            "price" => 500,

        ]);
        UserPlans::create([
            "days_num" => 10,
            "social_media_appear" => 89000,
            "price" => 1000,

        ]);
    }
}
