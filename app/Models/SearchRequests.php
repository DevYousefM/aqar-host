<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchRequests extends Model
{
    use HasFactory;

    protected $fillable = [
        "type",
        "meters",
        "gov",
        "area",
        "rooms",
        "contract_type",
        "price",
    ];
}
