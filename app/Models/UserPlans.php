<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlans extends Model
{
    use HasFactory;

    protected $fillable = [
        "days_num",
        "social_media_appear",
        "price"
    ];
}
