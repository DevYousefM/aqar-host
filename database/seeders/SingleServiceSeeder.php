<?php

namespace Database\Seeders;

use App\Models\SingleService;
use Illuminate\Database\Seeder;

class SingleServiceSeeder extends Seeder
{
    public function run(): void
    {
        SingleService::create([
            "name" => "account_company_service",
            "price" => 5000,
        ]);
        SingleService::create([
            "name" => "add_properties_service",
            "price" => 2000,
        ]);
        SingleService::create([
            "name" => "header_service",
            "price" => 5000,
        ]);
        SingleService::create([
            "name" => "slider_service",
            "price" => 3000,
        ]);
        SingleService::create([
            "name" => "special_property_service",
            "price" => 250,
        ]);
        SingleService::create([
            "name" => "youtube_service",
            "price" => 2000,
        ]);
        SingleService::create([
            "name" => "google_service",
            "price" => 1000,
        ]);
        SingleService::create([
            "name" => "facebook_service",
            "price" => 500,
        ]);
    }
}
