<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPlans extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "property_num",
        "special_property_num",
        "facebook_ads_num",
        "header_appear_days",
        "slider_appear_days",
        "youtube_ads_num",
        "google_ads_num",
        "price",
        "three_month",
        "six_month",
        "one_year",
        "last_price",
        
    ];

}
