<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "title_seo",
        "url_name",
        "brief",
        "image",
        "image_alt",
        "body",
    ];
}
