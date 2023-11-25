<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "path",
    ];
}
