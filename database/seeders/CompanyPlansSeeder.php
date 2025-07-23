<?php

namespace Database\Seeders;

use App\Models\CompanyPlans;
use Illuminate\Database\Seeder;

class CompanyPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyPlans::create([
            "name" => "silver",
            "property_num" => 20,
            "special_property_num" => 50,
            "facebook_ads_num" => 10,
            "header_appear_days" => null,
            "slider_appear_days" => null,
            "youtube_ads_num" => null,
            "google_ads_num" => null,
            "price" => 11000,
            "last_price" => 22000,
        ]);
        CompanyPlans::create([
            "name" => "gold",
            "property_num" => 40,
            "special_property_num" => 100,
            "facebook_ads_num" => 20,
            "header_appear_days" => 5,
            "slider_appear_days" => 5,
            "youtube_ads_num" => null,
            "google_ads_num" => null,
            "price" => 29600,
            "last_price" => 74000,
        ]);
        CompanyPlans::create([
            "name" => "platinum",
            "property_num" => 70,
            "special_property_num" => 200,
            "facebook_ads_num" => 40,
            "header_appear_days" => 10,
            "slider_appear_days" => 10,
            "youtube_ads_num" => 5,
            "google_ads_num" => 5,
            "price" => 49800,
            "last_price" => 166000,
        ]);
    }
}
